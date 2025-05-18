<div data-id="open" class="shapla-toggle shapla-toggle--stroke">
    <span class="shapla-toggle-title">
        <?php _e( 'Navigation Settings', 'venus-slider' ); ?>
    </span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
            <?php 
            $this->form->checkbox( array( 
                'id'    => '_nav_button',
                'name'  => __( 'Navigation', 'venus-slider' ),
                'label' => __( 'Navigation', 'venus-slider' ),
                'desc'  => __( 'Check to show next/prev icons.', 'venus-slider' )
            ) );
            $this->form->checkbox( array( 
                'id'    => '_dot_nav',
                'name'  => __( 'Dots', 'venus-slider' ),
                'label' => __( 'Dots', 'venus-slider' ),
                'desc'  => __( 'Check to show dots navigation.', 'venus-slider' )
            ) );
            $this->form->checkbox( array( 
                'id'    => '_nav_color',
                'type'  => 'color',
                'name'  => __( 'Navigation & Dots Color ', 'venus-slider' ),
                'desc'  => __( 'Pick a color for navigation and dots.', 'venus-slider' ),
                'std'   => '#f1f1f1'
            ) );
            $this->form->checkbox( array( 
                'id'    => '_nav_active_color',
                'name'  => __( 'Navigation & Dots Color: Hover & Active', 'venus-slider' ),
                'desc'  => __( 'Pick a color for navigation and dots for active and hover effect.', 'venus-slider' ),
                'std'   => '#4caf50'
            ) );
            ?>
        </div>
    </div>
</div>