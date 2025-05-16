<div data-id="open" class="shapla-toggle shappla-toggle--stroke">
    <span class="shapla-toggle-title">
        <?php _e( 'General Settings', 'venus-slider' ); ?>
    </span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
            <?php 
            $this->form->image_sizes( array(
                'id'   => __( '_image_size', 'venus-slider' ),
                'name' => __( 'Carousel Image size', 'venus-slider' ),
                'desc' => sprintf( __( 'Select "original uploaded image" for full size image or your desired image size for carousel image. You can change the default size for thumbnail, medium and large from %1$s Settings >> Media %2$s.', 'venus-slider' ), '<a target="_blank"' . get_admin_url() . 'options-media.php">', '</a>'),
            ) );
            $this->form->checkbox( array(
                'id'    => '_lazy_load_image',
                'name'  => __( 'Lazy load image', 'venus-slider' ),
                'label' => __( 'Lazy load image', 'venus-slider' ),
                'desc'  => __( 'Check to enable image lazy load.', 'venus-slider' ),
                'std'   => __( 'off' ),
            ) );
            $this->form->text( array(
                'id'   => '_slide_by',
                'name' => __( 'Slide By', 'venus-slider' ),
                'desc' => __( 'Navigation slide by x number. Write "page" with inverted comma to slide by page. Default value is 1.', 'venus-slider' ),
                'std'  => 1
            ) );
            $this->form->number( array(
                'id'   => '_margin_right',
                'name' => __( 'Margin Right(px) on item.', 'venus-slider' ),
                'desc' => __( 'margin-right(px) on item. Default value is 10. Example: 20', 'venus-slider' ),
                'std'  => 10
            ) );
            $this->form->checkbox( array(
                'id'    => '_infinity_loop',
                'name'  => __( 'Infinity loop', 'venus-slider' ),
                'label' => __( 'Infinity loop.', 'venus-slider' ),
                'desc'  => __( 'Check to show infinity loop. Duplicate last and first items to get loop illusion', 'venus-slider' ),
                'std'   => 'on'
            ) );
            ?>
        </div>
    </div>
</div>