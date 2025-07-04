<?php $img_settings = ( $slide_type == 'image-carousel' ) || ( $slide_type == 'image-carousel-url' ) ? true : false; ?>
<div data-id="open" id="section_images_general_settings" class="shapla-toggle shapla-toggle--stroke"
     style="display: <?php echo ! $img_settings ? 'none' : 'block'; ?>">
	<span class="shapla-toggle-title">
		<?php esc_html_e( 'Image Carousel Settings', 'venus-slider' ); ?>
	</span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
			<?php
			$this->form->checkbox( array(
				'id'    => '_show_attachment_title',
				'name'  => esc_html__( 'Show Image Title', 'venus-slider' ),
				'label' => esc_html__( 'Show Image Title', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show title below image. Only works with image carousel.', 'venus-slider' ),
				'std'   => 'off'
			) );
			$this->form->checkbox( array(
				'id'    => '_show_attachment_caption',
				'name'  => esc_html__( 'Show Image Caption', 'venus-slider' ),
				'label' => esc_html__( 'Show Image Caption', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show caption below image. Only works with image carousel.', 'venus-slider' ),
				'std'   => 'off'
			) );
			$this->form->select( array(
				'id'      => '_image_target',
				'name'    => esc_html__( 'Image Target', 'venus-slider' ),
				'desc'    => esc_html__( 'Choose where to open the linked image.', 'venus-slider' ),
				'std'     => '_self',
				'options' => array(
					'_self'  => esc_html__( 'Open in the same frame as it was clicked', 'venus-slider' ),
					'_blank' => esc_html__( 'Open in a new window or tab', 'venus-slider' ),
				),
			) );
			$this->form->checkbox( array(
				'id'    => '_image_lightbox',
				'name'  => esc_html__( 'Show Lightbox Gallery', 'venus-slider' ),
				'label' => esc_html__( 'Show Lightbox Gallery', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show lightbox gallery.', 'venus-slider' ),
				'std'   => 'off'
			) );
			?>
        </div>
    </div>
</div>