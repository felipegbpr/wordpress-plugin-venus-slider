<div data-id="open" id="section_video_settings" class="shapla-toggle shapla-toggle--stroke"
     style="display: <?php echo $slide_type != 'video-carousel' ? 'none' : 'block'; ?>">
	<span class="shapla-toggle-title">
		<?php esc_html_e( 'Video Settings', 'venus-slider' ); ?>
	</span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
			<?php
			$this->form->textarea( array(
				'id'   => '_video_url',
				'name' => esc_html__( 'Video URLs', 'venus-slider' ),
				'desc' => sprintf(
					'%s<br><br>Example: %s',
					esc_html__( 'Only support youtube and vimeo. Enter video URL from youtube or vimeo separating each by comma', 'venus-slider' ),
					'Insert a video'
				),
			) );
			$this->form->number( array(
				'id'   => '_video_width',
				'name' => esc_html__( 'Video Width', 'venus-slider' ),
				'std'  => 560,
				'desc' => esc_html__( 'Enter video width in numbers.', 'venus-slider' ),
			) );
			$this->form->number( array(
				'id'   => '_video_height',
				'name' => esc_html__( 'Video Height', 'venus-slider' ),
				'std'  => 315,
				'desc' => esc_html__( 'Enter video height in numbers.', 'venus-slider' ),
			) );
			?>
        </div>
    </div>
</div>