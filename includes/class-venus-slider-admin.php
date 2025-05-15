<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'VenusSliderAdmin' ) ) :

    class VenusSliderAdmin {
        private $plugin_path;
        private $plugin_url;
        private $form;

        /**
         * VenusSliderAdmin constructor
         *
         */
        public function __construct() {
            $this->plugin_path = VENUS_SLIDER_PATH;
            $this->plugin_url  = VENUS_SLIDER_URL;
            $this->form        = new VenusSliderForm(); 

            add_action( 'init', array( $this, 'venus_slider_post_type' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );


            add_filter( 'manage_edit-carousels_columns', array( $this, 'columns_head' ) );
            add_filter( 'manage_carousels_posts_custom_column', array( $this, 'columns_content' ), 10, 2 );

            // Remove view and quick edit from carousels 
            add_filter( 'post_row_actions', array( $this, 'post_row_actions' ), 10, 2 );
        } 

        /**
         * Venus Slider post type
         */
        public function venus_slider_post_type() {
                $labels = array(
                        'name'                   => _x( 'Slides', 'Post Type General Name', 'venus-slider' ),
                        'singular_name'          => _x( 'Slide', 'Post Type Singular Name', 'venus-slider' ),
                        'menu_name'              => __( 'Venus Slider', 'venus-slider' ),
                        'parent_item_colon'      => __( 'Parent Slide:', 'venus-slider' ),
                        'all_items'              => __( 'All Slides', 'venus-slider' ),
                        'view_item'              => __( 'View Slide', 'venus-slider' ),
                        'add_new_item'           => __( 'Add New Slider', 'venus-slider' ),
                        'add_new'                => __( 'Add New', 'venus-slider' ),
                        'edit_item'              => __( 'Edit Slide', 'venus-slider' ),
                        'update_item'            => __( 'Update Slide', 'venus-slider' ),
                        'search_items'           => __( 'Search Slide', 'venus-slider' ),
                        'not_found'              => __( 'Not Found', 'venus-slider' ),
                        'not_found_in_trash'     => __( 'Not Found in Trash', 'venus-slider' ),
                );
                $args   = array(
                        'label'                  => __( 'Slide', 'venus-slider' ),
                        'description'            => __( 'Easily create and manage responsive carousel slides', 'venus-slider' ),
                        'labels'                 => $labels,
                        'supports'               => array( 'title' ),
                        'hierarchical'           => false,
                        'public'                 => false,
                        'show_ui'                => true,
                        'show_in_menu'           => true,
                        'show_in_nav_menus'      => true,
                        'show_in_admin_bar'      => true,
                        'menu_position'          => 5.55525,
                        'menu_icon'              => 'dashicons-slides',
                        'can_export'             => true,
                        'has_archive'            => false,
                        'exclude_from_search'    => true,
                        'publicly_queryable'     => true,
                        'rewrite'                => false,
                        'capability_type'        => 'post',
                ); 

                register_post_type('venus-slider', $args);
        }
        
        /**
         * Hide view and quick edit from venus slider admin
         * 
         * @param $actions
         * @param $post
         * 
         * @return mixed 
         */
        public function post_row_actions( $actions, $post ) {
            global $current_screen;
            if ( $current_screen->post_type != 'venus-slider' ) {
                return $actions;
            }

            unset( $actions['view'] );
            unset( $actions['inline hide-if-no-js'] );

            return $actions;
        }

        /**
         * Customize Venus Slider list table head
         */
        public function columns_head() {

            $columns = array(
                'cb'  => '<input type="checkbox"',
                'title'  => __( 'Venus Slider Title', 'venus-slider' ),
                'usage'  => __( 'Shortcode', 'venus-slider' ),
                'slider_type'  => __( 'Slide Type', 'venus-slider' ),
            );

            return $columns;
        }

        /**
         * Generate venus slider list table content
         * 
         * @param $column
         * @param $post_id
         */
        public function columns_content( $column, $post_id ) {
            switch ( $column ) {

                case 'usage':
                    ?>
                    <input 
                        type="text"
                        onmousedown="this.clicked = 1;"
                        onfocus="if (!this.clicked) this.select(); else this.clicked = 2;"
                        onclick="if (this.clicked == 2) this.select(); this.clicked = 0;"
                        value="[venus_slide id='<?php echo $post_id; ?>']"
                        style="background-color: #f1f1f1;font-family: monospace;min-width: 250px;padding: 5px 8px;"
                    />
                   <?php 

                   break;
                
                case 'slider_type':
                    $slide_type = get_post_meta( get_the_ID(), '_slide_type', true );   
                    echo ucwords( str_replace( '-', '', $slide_type ) );
                    
                    break;

                default: 
                    break;    
            }
        }

        /**
         * Add venus slider meta box
         */
        public function add_meta_boxes() {
            add_meta_box(
                "venus-slider-meta-boxes",
                __( "Venus Slider", 'venus-slider' ),
                array( $this, 'venus_slider_meta_boxes' ),
                'carousels',
                'normal',
                'high'
            );
        }

        /**
         * Load meta box content
         */
        public function venus_slider_meta_boxes() {
            wp_nonce_field( 'venus_slider_nonce', '_venus_slider_nonce' );

            global $post;
            $slide_type = get_post_meta( $post->ID, '_slide_type', true );
            $slide_type = in_array( $slide_type, array(
                'image-carousel',
                'post-carousel',
                'image-carousel-url',
                'video-carousel',
                'product-carousel',
            ) ) ? $slide_type : 'image-carousel';

            require_once VENUS_SLIDER_TEMPLATES . '/admin/types.php';
            require_once VENUS_SLIDER_TEMPLATES . '/admin/images-media.php';
            require_once VENUS_SLIDER_TEMPLATES . '/admin/images-url.php';
            require_once VENUS_SLIDER_TEMPLATES . '/admin/post-carousel.php';
            require_once VENUS_SLIDER_TEMPLATES . '/admin/product-carousel.php';
            require_once VENUS_SLIDER_TEMPLATES . '/admin/video-carousel.php';
            require_once VENUS_SLIDER_TEMPLATES . '/admin/images-settings.php';
            require_once VENUS_SLIDER_TEMPLATES . '/admin/general.php';
            require_once VENUS_SLIDER_TEMPLATES . '/admin/navigation.php';
            require_once VENUS_SLIDER_TEMPLATES . '/admin/autoplay.php';
            require_once VENUS_SLIDER_TEMPLATES . '/admin/responsive.php';
        }

        /**
         * Meta Box for shortcode information
         */
        public function shortcode_usage_info() {
            add_meta_box(
                "venus-slider-shortcode-info",
                __( "Usage (Shortcode)", 'venus-slider' ),
                array( $this, 'render_meta_box_shortcode_info' ),
                'carousels',
                'side',
                'low'
            );
        }

        /**
         * Render shortcode meta box content
         */
        public function render_meta_box_shortcode_info() {
            ob_start(); ?>

            <p>
                <strong><?php _e( 'Copy the following shortcode and paste in post or page where you want to show.', 'venus-slider' ); ?></strong>
            </p>
            <input 
                type="text"
                onmousedown="this.clicked = 1;"
                onfocus="if(!this.clicked) this.select(); else this.clicked = 2;"
                onclick="if (this.clicked == 2) this.select(); this.clicked = 0;"
                value="[venus_slider id='<?php echo get_the_ID(); ?>']"
                style="background-color: #f1f1f1; width: 100%; padding: 8px;"
            />
            <hr/>
            <p>
                <?php _e( 'If this plugin has helped you, consider supporting its development with a small donation. Every bit helps keep the updates coming and the coffee flowing!', 'venus-slider' ); ?>
            </p>
            <p style="text-align: center;">
                <a target="_blank" href="#">
                    <img src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" alt="PayPal Donate">
                </a>
            </p>

            <?php echo ob_get_clean();
        }

    }

endif;    

new VenusSliderAdmin();