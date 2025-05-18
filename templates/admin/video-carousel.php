<div data-id="open" id="section_video_settings" class="shapla-toggle shapla-toggle--stroke"
    style="display: <?php echo $slide_type != 'video-carousel' ? 'none' : 'block'; ?>">
    <span class="shapla-toggle-title">
        <?php _e( 'Video Settings', 'venus-slider' ) ?>
    </span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
            <?php 
            $this->form->textarea( array( 
                'id'   => '_video_url',
                'name' => __( 'Video URLs', 'venus-slider' ),
                'desc' => sprintf( '%s<br><br>Example: %s', __( 'Only support youtube and vimeo. Enter video URL from youtube or vimeo separating each by comma', 'venus-slider' ), __( 'https://www.youtube.com/watch?v=FcTLMTyD2DU,https://youtu.be/9Ux9U8qsAzQ?si=CO_l-kRLNRvRzBC7,https://vimeo.com/193517656' ) ),
            ) );
            $this->form->number( array( 
                'id'   => '_video_width',
                'name' => __( 'Video Width', 'venus-slider' ),
                'std'  => 560,
                'desc' => __( 'Enter video width in numbers.', 'venus-slider' ),
            ) );
            $this->form->numbe( array( 
                'id'   => '_video_height',
                'name' => __( 'Video Height', 'venus-slider' ),
                'std'  => 315,
                'desc' => __( 'Enter video height in numbers.', 'venus-slider' ),
            ) );
            ?>
        </div>
    </div>
</div>