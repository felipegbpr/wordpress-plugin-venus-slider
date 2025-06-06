<div data-id="open" class="shapla-toggle shapla-toggle--stroke">
	<span class="shapla-toggle-title">
		<?php esc_html_e( 'Navigation Settings', 'venus-slider' ); ?>
	</span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
			<?php
			$this->form->checkbox( array(
				'id'    => '_nav_button',
				'name'  => esc_html__( 'Navigation', 'venus-slider' ),
				'label' => esc_html__( 'Navigation', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show next/prev icons.', 'venus-slider' ),
			) );
			$this->form->checkbox( array(
				'id'    => '_dot_nav',
				'name'  => esc_html__( 'Dots', 'venus-slider' ),
				'label' => esc_html__( 'Dots', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show dots navigation.', 'venus-slider' ),
			) );
			$this->form->color( array(
				'id'   => '_nav_color',
				'type' => 'color',
				'name' => esc_html__( 'Navigation & Dots Color	', 'venus-slider' ),
				'desc' => esc_html__( 'Pick a color for navigation and dots.', 'venus-slider' ),
				'std'  => '#f1f1f1'
			) );
			$this->form->color( array(
				'id'   => '_nav_active_color',
				'name' => esc_html__( 'Navigation & Dots Color: Hover & Active', 'venus-slider' ),
				'desc' => esc_html__( 'Pick a color for navigation and dots for active and hover effect.', 'venus-slider' ),
				'std'  => '#4caf50'
			) );
			?>
        </div>
    </div>
</div>