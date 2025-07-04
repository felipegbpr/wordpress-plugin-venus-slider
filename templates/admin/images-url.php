<?php
$_images_urls = get_post_meta( $post->ID, '_images_urls', true );
$btn_text     = $_images_urls ? 'Edit URLs' : 'Add URLs';
?>
<div data-id="open" id="section_url_images_settings" class="shapla-toggle shapla-toggle--stroke"
     style="display: <?php echo $slide_type != 'image-carousel-url' ? 'none' : 'block'; ?>">
	<span class="shapla-toggle-title">
		<?php esc_html_e( 'URL Images', 'venus-slider' ); ?>
	</span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
			<?php
			$this->form->images_url( array(
				'id'   => '_images_urls',
				'name' => esc_html__( 'Images URLs', 'venus-slider' ),
				'desc' => esc_html__( 'Enter external images URLs.', 'venus-slider' ),
			) );
			?>
        </div>
    </div>
</div>

<!-- The Modal -->
<div id="VenusSliderModal" class="venus_slider-modal">

    <!-- Modal content -->
    <div class="venus_slider-modal-content">
        <div class="venus_slider-modal-header">
            <span class="venus_slider-close">&times;</span>
			<?php esc_html_e( 'Image Carousel - from URL', 'venus-slider' ); ?>
        </div>
        <div class="venus_slider-modal-body">
            <div id="venus_slider_form" class="venus_slider-form">
				<?php if ( is_array( $_images_urls ) ): foreach ( $_images_urls as $image ): ?>
                    <div class="venus_slider-fields">
                        <label class="setting">
                            <span class="name"><?php esc_html_e( 'URL', 'venus-slider' ); ?></span>
                            <input type="url" name="_images_urls[url][]" value="<?php echo $image['url']; ?>"
                                   autocomplete="off">
                        </label>
                        <label class="setting">
                            <span class="name"><?php esc_html_e( 'Title', 'venus-slider' ); ?></span>
                            <input type="text" name="_images_urls[title][]" value="<?php echo $image['title']; ?>"
                                   autocomplete="off">
                        </label>
                        <label class="setting">
                            <span class="name"><?php esc_html_e( 'Caption', 'venus-slider' ); ?></span>
                            <textarea name="_images_urls[caption][]"><?php echo $image['caption']; ?></textarea>
                        </label>
                        <label class="setting">
                            <span class="name"><?php esc_html_e( 'Alt Text', 'venus-slider' ); ?></span>
                            <input type="text" name="_images_urls[alt][]" value="<?php echo $image['alt']; ?>"
                                   autocomplete="off">
                        </label>
                        <label class="setting">
                            <span class="name"><?php esc_html_e( 'Link To URL', 'venus-slider' ); ?></span>
                            <input type="text" name="_images_urls[link_url][]" value="<?php echo $image['link_url']; ?>"
                                   autocomplete="off">
                        </label>
                        <div class="actions">
                            <span><span class="dashicons dashicons-move"></span></span>
                            <span class="add_row"><span class="dashicons dashicons-plus-alt"></span></span>
                            <span class="delete_row"><span class="dashicons dashicons-trash"></span></span>
                        </div>
                    </div>
				<?php endforeach; else: ?>
                    <div class="venus_slider-fields">
                        <label class="setting">
                            <span class="name"><?php esc_html_e( 'URL', 'venus-slider' ); ?></span>
                            <input type="url" name="_images_urls[url][]" value="">
                        </label>
                        <label class="setting">
                            <span class="name"><?php esc_html_e( 'Title', 'venus-slider' ); ?></span>
                            <input type="text" name="_images_urls[title][]" value="">
                        </label>
                        <label class="setting">
                            <span class="name"><?php esc_html_e( 'Caption', 'venus-slider' ); ?></span>
                            <textarea name="_images_urls[caption][]"></textarea>
                        </label>
                        <label class="setting">
                            <span class="name"><?php esc_html_e( 'Alt Text', 'venus-slider' ); ?></span>
                            <input type="text" name="_images_urls[alt][]" value="">
                        </label>
                        <label class="setting">
                            <span class="name"><?php esc_html_e( 'Link To URL', 'venus-slider' ); ?></span>
                            <input type="text" name="_images_urls[link_url][]" value="">
                        </label>
                        <div class="actions">
                            <span><span class="dashicons dashicons-move"></span></span>
                            <span class="add_row"><span class="dashicons dashicons-plus-alt"></span></span>
                            <span class="delete_row"><span class="dashicons dashicons-trash"></span></span>
                        </div>
                    </div>
				<?php endif; ?>
            </div>
        </div>
        <div class="venus_slider-modal-footer">
            <button class="button button-primary" id="save_carousel_images_urls">
				<?php esc_html_e( 'Save', 'venus-slider' ); ?>
            </button>
        </div>
    </div>

</div>