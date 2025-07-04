<div data-id="open" id="section_images_settings" class="shapla-toggle shapla-toggle--stroke"
     style="display: <?php echo $slide_type != 'image-carousel' ? 'none' : 'block'; ?>">
	<span class="shapla-toggle-title">
		<?php esc_html_e( 'Media Images', 'venus-slider' ); ?>
	</span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
			<?php
			$this->form->images_gallery( array(
				'id'   => '_wpdh_image_ids',
				'name' => esc_html__( 'Carousel Images', 'venus-slider' ),
				'desc' => esc_html__( 'Choose carousel images from media library.', 'venus-slider' ),
			) );
			?>
        </div>
    </div>
</div>