<?php

if ( ! function_exists( 'venus_slider' ) ) {
    function venus_slider() {
        return VenusSlider::instance();
    }
}

if ( ! function_exists( 'venus_slider_is_url' ) ) {
    /**
     * Check if url is valid as per RFC 2396 Generic Syntax
     * 
     * @param string $url
     * 
     * @return boolean
     */
    function venus_slider_is_url( $url ) {
        if ( filter_var( $url, FILTER_VALIDATE_URL ) ) {

            return true;
        }

        return false;
    }   
}

if ( ! function_exists( 'venus_slider_get_meta' ) ) {
    /**
     * Get post meta by id and key
     * 
     * @param $id
     * @param $key
     * @param null $default
     * 
     * @return string
     */
    function venus_slider_get_meta( $id, $key, $default = null ) {
        $meta = get_post_meta( $id, $key, true );

        if ( empty( $meta ) && $default ) {
            $meta = $default;
        }

        if ( $meta == 'zero' ) {
            $meta = '0';
        }   

        if ( $meta == 'on' ) {
            $meta = 'true';
        }

        if ( $meta == 'off' ) {
            $meta = 'false';
        }

        if ( $key == '_margin_right' && $meta == 0 ) {
            $meta = '0';
        }

        return esc_attr( $meta );
    }
}   

if ( ! function_exists( 'venus_slider_array_to_attribute' ) ) {
    /**
     * Convert array to html data attribute
     * 
     * @param array
     * 
     * @return array|string
     */
    function venus_slider_array_to_attribute( $array ) {
        if ( ! is_array( $array ) ) {
            return '';
        }

        $attribute = array_map(function ( $key, $value ) {
            // If boolean value
            if ( is_bool( $value ) ) {
                if ( $value ) {

                    return sprintf( '%s="%s"', $key, 'true' );
                } else {

                    return sprintf( '%s="%s"', $key, 'false' );
                }
            }
            // If array value
            if ( is_array( $value ) ) {

                return sprintf( '%s="%s"', $key, implode( " ", $value ) );
            }

            // If string value
            return sprintf( '%s="%s"', $key, esc_attr( $value ) );
        }, array_keys( $array ), array_values( $array ) );

        return $attribute; 
    }
}   

if ( ! function_exists( 'venus_slider_is_woocommerce_active' ) ) {
    /**
     * Check if WooCommerce is active
     * 
     * @return bool
     */
    function venus_slider_is_woocommerce_active() {

        if ( in_array( 'woocommerce/woocommerce.php', get_option( 'active_plugins' ) ) ) {
            return true;
        }

        return false;
    }
}