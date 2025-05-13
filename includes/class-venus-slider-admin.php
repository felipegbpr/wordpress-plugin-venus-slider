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
            
                                        // TO-DO
            // $this->form        = new VenusSliderForm(); 

            add_action( 'init', array( $this, 'venus_slider_post_type' ) );
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

    }

endif;    

new VenusSliderAdmin();