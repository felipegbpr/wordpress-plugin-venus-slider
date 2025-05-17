<?php 
$img_settings = ( $slide_type == 'image-carousel' ) || ( $slide_type == 'images-carousel-url' ) ? true : false;
?>
<div data-id="open" id="section_images_general_settings" class="shapla-toggle shapla-toggle--stroke"
    style="display: <?php echo ! $img_settings ? 'none' : 'block'; ?>">
    <span class="shapla-toggle-title">
        <?php _e( 'Image Carousel Settings', 'venus-slider' ); ?>
    </span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
            <?php 
            $this->form->checkbox( array( 
                'id'    => '_show_attachment_title',
                'name'  => __( 'Show Image Title', 'venus-slider' ),
                'label' => __( 'Show Image Title', 'venus-slider' ),
                'desc'  => __( 'Check to show title below image. Only works with image carousel.', 'venus-slider' ),
                'std'   => 'off'
            ) );
            $this->form->checkbox( array( 
                'id'    => '_show_attachment_caption',
                'name'  => __( 'Show Image Caption', 'venus-slider' ),
                'label' => __( 'Show Image Caption', 'venus-slider' ),
                'desc'  => __( 'Check to show caption below image. Only works with image carousel.', 'venus-slider' ),
                'std'   => 'off'
            ) );
            $this->form->select( array( 
                'id'      => '_image_target',
                'name'    => __( 'Image Target', 'venus-slider' ),
                'desc'    => __( 'Choose where to open the linked image.', 'venus-slider' ),
                'std'     => '_self',
                'options' => array(
                        '_self'  => __( 'Open in the same frame as it was clicked', 'venus-slider' ),
                        '_blank' => __( 'Open in a new window or tab', 'venus-slider' ),
                ),
            ) );
            $this->form->checkbox( array( 
                'id'    => '_image_lightbox',
                'name'  => __( 'Show Lightbox Gallery', 'venus-slider' ),
                'label' => __( 'Show Lightbox Gallery', 'venus-slider' ),
                'desc'  => __( 'Check to show lightbox gallery.', 'venus-slider' ),
                'std'   => 'off'
            ) );
            ?>
        </div>
    </div>
</div>