<div data-id="open" class="shapla-toggle shapla-toggle--stroke">
    <span class="shapla-toggle-title">
        <?php _e( 'Autoplay Settings', 'venus-slider' ); ?>
    </span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
            <?php 
            $this->form->checkbox( array( 
                'id'    => '_autoplay',
                'name'  => __( 'Autoplay', 'venus-slider' ),
                'label' => __( 'Autoplay.', 'venus-slider' ),
                'desc'  => __( 'Check to enable autoplay', 'venus-slider' ),
                'std'   => 'on'
            ) );
            $this->form->number( array( 
                'id'    => '_autoplay_timeout',
                'name'  => __( 'Autoplay Timeout', 'venus-slider' ),
                'desc'  => __( 'Autoplay interval timeout in millisecond. Default: 5000', 'venus-slider' ),
                'std'   => 5000
            ) );
            $this->form->number( array( 
                'id'    => '_autoplay_speed',
                'name'  => __( 'Autoplay Speed', 'venus-slider' ),
                'desc'  => __( 'Autoplay speen in millisecond. Default: 500', 'venus-slider' ),
                'std'   => 500
            ) );
            $this->form->checkbox( array( 
                'id'    => '_autoplay_pause',
                'name'  => __( 'Autoplay Hover Pause', 'venus-slider' ),
                'label' => __( 'Pause on mouse hover.', 'venus-slider' ),
                'desc'  => __( 'Pause autoplay on mouse hover.', 'venus-slider' ),
            ) );
            ?>
        </div>
    </div>
</div>