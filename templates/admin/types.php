<div class="sp-input-group" style="margin: 10px 0 30px;">
    <div class="sp-input-label">
        <label for="_venus_slider_slide_type">
            <?php _e( 'Slide Type', 'venus-slider' ); ?>
        </label>
    </div>
    <div class="sp-input-field">
        <select name="venus_slider[_slide_type]" id="_venus_slider_slide_type" class="sp-input-text">
            <option value="image-carousel" <?php echo $slide_type == 'image-carousel' ? 'selected' : ''; ?>>
                <?php _e( 'Image Carousel - from Media Library', 'venus-slider' ); ?>
            </option>
            <option value="image-carousel-url" <?php echo $slide_type == 'image-carousel-url' ? 'selected' : ''; ?>>
                <?php _e( 'Image Carousel - from URL', 'venus-slider' ); ?>
            </option>
            <option value="post-carousel" <?php echo $slide_type == 'post-carousel' ? 'selected' : ''; ?>>
                <?php _e( 'Post Carousel', 'venus-slider' ); ?>
            </option>
            <option value="video-carousel" <?php echo $slide_type == 'video-carousel' ? 'selected' : ''; ?>>
                <?php _e( 'Video Carousel', 'venus-slider' ); ?>
            </option>
            <?php $disabled = $this->is_woocommerce_active() ? '' : 'disabled'; ?>
            <option value="product-carousel" <?php echo $slide_type == 'product-carousel' ? 'selected' : ''; ?> <?php echo $disabled ?>>
                <?php _e( 'WooCommerce Product Carousel', 'venus-slider' ); ?>
            </option>
        </select>
    </div>
</div>