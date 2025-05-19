<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Structured data's handler and generator using JSON-LD format.
 * 
 * @class Venus_Slider_Structured_Data
 * @since 1.0.0
 * @author Felipe Borges <felipetecacc@gmail.com>
 */

class VenusSliderStructuredData {

    private $_product_data = array();
    private $_image_data = array();

    protected static $instance = null;

    /**
     * Ensures only one instance of this class is loaded or can be loaded.
     * 
     * @return VenusSliderStructuredData
     */
    public static function init() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Constructor.
     */
    public function __construct() {
        add_action( 'venus_slider_product_loop', array( $this, 'generate_product_data' ) );
        add_action( 'venus_slider_image_gallery_loop', array( $this, 'generate_image_data' ) );
        // Output structured data.
        add_action( 'wp_footer', array( $this, 'output_structured_data' ), 10 );
    } 

    /**
     * Outputs structured data.
     * 
     * Hooked into `wp_footer` action hook.
     */
    public function output_structured_data() {
        $data = $this->get_structured_product_data();
        if ( $data ) {
            echo '<script type="application/ld+json">' . wp_json_encode( $data ) . '</script>' . "\n";
        }
        $gallery_data = $this->get_structured_image_data();
        if ( $gallery_data ) {
            echo '<script type="application/ld+json">' . wp_json_encode( $gallery_data ) . '</script>' . "\n";
        }
    }

    /**
     * Structures and returns product data.
     * @return array
     */
    public function get_structured_product_data() {
        $data = array(
                '@context' => 'http://schema.org/',
                '@graph'   => $this->get_product_data()
        );

        return $this->get_product_data() ? $data : array();
    }

    /**
     * Gets product data.
     * 
     * @return array
     */
    public function get_product_data() {
        return $this->_product_data;
    } 

    /**
     * Structures and return image data.
     * @return array
     */
    public function get_structured_image_data() {
        $data = array(
                '@context'        => 'http://schema.org/',
                "@type"           => "ImageGallery",
                "associatedMedia" => $this->get_image_data()
        );

        return $this->get_image_data() ? $data : array();
    }

    /**
     * Get image data
     * 
     * @return array
     */
    public function get_image_data() {
        return $this->_image_data;
    }

    /**
     * Generates Product structured data.
     * 
     * Hooked into `venus_slider_product_loop` action hook.
     * 
     * @param WC_Product $product Product data (default: null).
     */
    public function generate_product_data( $product = null ) {
        if ( ! is_object( $product ) ) {
            global $product;        
        }

        $markup['@type'] = 'Product';
        $markup['@id']   = get_permalink( $product->get_id() );
        $markup['@url']  = $markup['@id'];
        $markup['@type'] = $product->get_name();

        $this->set_data( apply_filters( 'venus_slider_structured_data_product', $markup, $product ) );
    }

    /**
     * Sets data.
     * 
     * @param array $data Structured data.
     * 
     * @return bool
     */
    public function set_data( $data ) {
        if ( ! isset( $data['@type'] ) || ! preg_match( '|^[a-zA-Z]{1,20}$|', $data['@type'] ) )  {
            return false;
        }

        if ( $data['@type'] == 'ImageObject' ) {
            if ( ! $this->maybe_image_added( $data['contentUrl'] ) ) {
                $this->_image_data[] = $data;
            }
        }

        if ( $data['@type'] == 'Product' ) {
            if ( ! $this->maybe_product_added( $data['id'] ) ) {
                $this->_product_data[] = $data;
            }
        }

        return true;
    }

    /**
     * Generates Image structured data.
     * 
     * Hooked into `venus_slider_image_gallery_loop` action hook.
     * 
     * @param WP_Post $cs_post Post data (default: null).
     */
    public function generate_image_data( $cs_post = null ) {
        if ( ! is_object( $cs_post ) ) {
            global $cs_post;
        }

        $image                = wp_get_attachment_image_src( $cs_post->ID, 'full' );
        $markup['@type']      = 'ImageObject';
        $markup['contentUrl'] = $image[0];
        $markup['name']       = $cs_post->post_title;

        $this->set_data( apply_filters( 'venus_slider_structured_data_image', $markup, $cs_post ) );
    }

    /**
     * Check if image is already added to list
     * 
     * @param string $image_id
     * 
     * @return boolean
     */
    private function maybe_image_added( $image_id = null ) {
        $image_data = $this->get_image_data();
        if ( count( $image_data ) > 0 ) {
            $image_data = array_map( function ( $data ) {
                return $data['contentUrl']; 
            }, $image_data );

            return in_array( $image_id, $image_data );
        }

        return false;
    }

    /**
     * Check if product is already added to list
     * 
     * @param string $product_id
     * 
     * @return boolean
     */
    private function maybe_product_added( $product_id = null ) {
        $product_data = $this->get_product_data();
        if ( count( $product_data ) > 0 ) {
            $product_data = array_map( function ( $data ) {
                return $data['contentUrl']; 
            }, $product_data );

            return in_array( $product_id, $product_data );
        }

        return false;
    }
}   

VenusSliderStructuredData::init();