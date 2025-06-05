<?php
if ( ! class_exists( 'VenusSliderScripts' ) ):

	class VenusSliderScripts {

		protected static $instance = null;

		/**
		 * Ensures only one instance of this class is loaded or can be loaded.
		 *
		 * @return VenusSliderScripts
		 */
		public static function init() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ), 15 );
			add_action( 'wp_footer', array( $this, 'inline_script' ), 30 );

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ), 10 );
			add_action( 'admin_footer', array( $this, 'gallery_url_template' ), 5 );
		}

		/**
		 * Load frontend scripts
		 */
		public function frontend_scripts() {
			wp_register_style(
				'venus-slider',
				VENUS_SLIDER_ASSETS . '/css/style.css',
				array(),
				VENUS_SLIDER_VERSION,
				'all'
			);
			wp_register_script(
				'owl-carousel',
				VENUS_SLIDER_ASSETS . '/js/vendors/owl.carousel.min.js',
				array( 'jquery' ),
				'2.2.0',
				true
			);
			wp_register_script(
				'magnific-popup',
				VENUS_SLIDER_ASSETS . '/js/vendors/jquery.magnific-popup.min.js',
				array(),
				'1.1.0',
				true
			);

			if ( $this->should_load_scripts() ) {
				wp_enqueue_style( 'venus-slider' );
				wp_enqueue_script( 'owl-carousel' );
			}
		}

		/**
		 * Load admin scripts
		 *
		 * @param $hook
		 */
		public function admin_scripts( $hook ) {
			global $post;

			if ( $hook == 'post-new.php' || $hook == 'post.php' ) {

				if ( is_a( $post, 'WP_Post' ) && 'venus-carousels' == $post->post_type ) {
					wp_enqueue_media();
					wp_enqueue_style( 'wp-color-picker' );
					wp_enqueue_style(
						'venus-slider-admin',
						VENUS_SLIDER_ASSETS . '/css/admin.css',
						array(),
						VENUS_SLIDER_VERSION,
						'all'
					);
					wp_enqueue_script(
						'select2',
						VENUS_SLIDER_ASSETS . '/js/vendors/select2.min.js',
						array( 'jquery' ),
						'4.0.3',
						true
					);
					wp_enqueue_script(
						'venus-slider-admin',
						VENUS_SLIDER_ASSETS . '/js/admin.min.js',
						array(
							'jquery',
							'wp-color-picker',
							'jquery-ui-accordion',
							'jquery-ui-datepicker',
							'jquery-ui-sortable',
							'select2'
						),
						VENUS_SLIDER_VERSION,
						true
					);
				}
			}
		}

		/**
		 * Load front end inline script
		 */
		public function inline_script() {
			if ( $this->should_load_scripts() ):
				?>
                <script type="text/javascript">
                    jQuery(document).ready(function ($) {

                        $('body').find('.venus-slider').each(function () {
                            var _this = $(this);
                            var isVideo = _this.data('slide-type') == 'video-carousel' ? true : false;
                            var videoWidth = isVideo ? _this.data('video-width') : false;
                            var videoHeight = isVideo ? _this.data('video-height') : false;
                            var autoWidth = isVideo ? true : false;

                            if (jQuery().magnificPopup) {
                                var popupType = _this.data('slide-type') == 'product-carousel' ? 'ajax' : 'image';
                                var popupGallery = _this.data('slide-type') != 'product-carousel' ? true : false;
                                $(this).find('.magnific-popup').magnificPopup({
                                    type: popupType,
                                    gallery: {
                                        enabled: popupGallery
                                    },
                                    zoom: {
                                        enabled: popupGallery,
                                        duration: 300,
                                        easing: 'ease-in-out'
                                    }
                                });
                            }

                            if (jQuery().owlCarousel) {
                                _this.owlCarousel({
                                    nav: _this.data('nav'),
                                    dots: _this.data('dots'),
                                    margin: _this.data('margin'),
                                    loop: _this.data('loop'),
                                    autoplay: _this.data('autoplay'),
                                    autoplayTimeout: _this.data('autoplay-timeout'),
                                    autoplaySpeed: _this.data('autoplay-speed'),
                                    autoplayHoverPause: _this.data('autoplay-hover-pause'),
                                    slideBy: _this.data('slide-by'),
                                    lazyLoad: _this.data('lazy-load'),
                                    video: isVideo,
                                    videoWidth: videoWidth,
                                    videoHeight: videoHeight,
                                    autoWidth: autoWidth,
                                    navText: [_this.data('nav-previous-icon'), _this.data('nav-next-icon')],
                                    responsive: {
                                        320: {items: _this.data('colums-mobile')},
                                        600: {items: _this.data('colums-small-tablet')},
                                        768: {items: _this.data('colums-tablet')},
                                        993: {items: _this.data('colums-small-desktop')},
                                        1200: {items: _this.data('colums-desktop')},
                                        1921: {items: _this.data('colums')}
                                    }
                                });
                            }
                        });
                    });
                </script><?php
			endif;
		}

		/**
		 * Venus Slider gallery url template
		 *
		 * @return void
		 */
		public function gallery_url_template() {
			global $post_type;
			if ( $post_type != 'venus-carousels' ) {
				return;
			}
			?>
            <template id="venusSliderGalleryUrlTemplate" style="display: none;">
                <div class="venus_slider-fields">
                    <label class="setting">
                        <span class="name"><?php esc_html_e( 'URL', 'venus-slider' ); ?></span>
                        <input type="url" name="_images_urls[url][]" value="" autocomplete="off">
                    </label>
                    <label class="setting">
                        <span class="name"><?php esc_html_e( 'Title', 'venus-slider' ); ?></span>
                        <input type="text" name="_images_urls[title][]" value="" autocomplete="off">
                    </label>
                    <label class="setting">
                        <span class="name"><?php esc_html_e( 'Caption', 'venus-slider' ); ?></span>
                        <textarea name="_images_urls[caption][]"></textarea>
                    </label>
                    <label class="setting">
                        <span class="name"><?php esc_html_e( 'Alt Text', 'venus-slider' ); ?></span>
                        <input type="text" name="_images_urls[alt][]" value="" autocomplete="off">
                    </label>
                    <label class="setting">
                        <span class="name"><?php esc_html_e( 'Link To URL', 'venus-slider' ); ?></span>
                        <input type="text" name="_images_urls[link_url][]" value="" autocomplete="off">
                    </label>
                    <div class="actions">
                        <span><span class="dashicons dashicons-move"></span></span>
                        <span class="add_row"><span class="dashicons dashicons-plus-alt"></span></span>
                        <span class="delete_row"><span class="dashicons dashicons-trash"></span></span>
                    </div>
                </div>
            </template>
			<?php
		}

		/**
		 * Check if it should load frontend scripts
		 *
		 * @return boolean
		 */
		private function should_load_scripts() {
			global $post;
			$load_scripts = is_active_widget( false, false, 'widget_venus_slider', true ) ||
			                ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'venus_slide' ) ) ||
			                ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'carousel' ) );

			return apply_filters( 'venus_slider_load_scripts', $load_scripts );
		}
	}

endif;

VenusSliderScripts::init();