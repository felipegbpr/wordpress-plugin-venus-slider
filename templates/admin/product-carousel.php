<div data-id="open" id="section_product_query" class="shapla-toggle shapla-toggle--stroke"
     style="display: <?php echo $slide_type != 'product-carousel' ? 'none' : 'block'; ?>">
	<span class="shapla-toggle-title">
		<?php esc_html_e( 'Product Query', 'venus-slider' ); ?>
	</span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
			<?php
			$this->form->select( array(
				'id'      => '_product_query_type',
				'name'    => esc_html__( 'Query Type', 'venus-slider' ),
				'std'     => 'query_porduct',
				'options' => array(
					'query_porduct'      => esc_html__( 'Query Products', 'venus-slider' ),
					'product_categories' => esc_html__( 'Product Categories', 'venus-slider' ),
					'product_tags'       => esc_html__( 'Product Tags', 'venus-slider' ),
					'specific_products'  => esc_html__( 'Specific Products', 'venus-slider' ),
				),
			) );
			$this->form->select( array(
				'id'      => '_product_query',
				'name'    => esc_html__( 'Choose Query', 'venus-slider' ),
				'std'     => 'featured',
				'options' => array(
					'featured'     => esc_html__( 'Featured Products', 'venus-slider' ),
					'recent'       => esc_html__( 'Recent Products', 'venus-slider' ),
					'sale'         => esc_html__( 'Sale Products', 'venus-slider' ),
					'best_selling' => esc_html__( 'Best-Selling Products', 'venus-slider' ),
					'top_rated'    => esc_html__( 'Top Rated Products', 'venus-slider' ),
				),
			) );
			$this->form->post_terms( array(
				'id'       => '_product_categories',
				'taxonomy' => 'product_cat',
				'multiple' => true,
				'name'     => esc_html__( 'Product Categories', 'venus-slider' ),
				'desc'     => esc_html__( 'Show products associated with selected categories.', 'venus-slider' ),
			) );
			$this->form->post_terms( array(
				'id'       => '_product_tags',
				'taxonomy' => 'product_tag',
				'multiple' => true,
				'name'     => esc_html__( 'Product Tags', 'venus-slider' ),
				'desc'     => esc_html__( 'Show products associated with selected tags.', 'venus-slider' ),
			) );
			$this->form->posts_list( array(
				'id'        => '_product_in',
				'post_type' => 'product',
				'multiple'  => true,
				'name'      => esc_html__( 'Specific products', 'venus-slider' ),
				'desc'      => esc_html__( 'Select products that you want to show as slider. Select at least 5 products', 'venus-slider' ),
			) );
			$this->form->number( array(
				'id'   => '_products_per_page',
				'name' => esc_html__( 'Product per page', 'venus-slider' ),
				'std'  => 12,
				'desc' => esc_html__( 'How many products you want to show on carousel slide.', 'venus-slider' ),
			) );
			$this->form->checkbox( array(
				'id'    => '_product_title',
				'name'  => esc_html__( 'Show Title', 'venus-slider' ),
				'label' => esc_html__( 'Show Title.', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show product title.', 'venus-slider' ),
				'std'   => 'on'
			) );
			$this->form->checkbox( array(
				'id'    => '_product_rating',
				'name'  => esc_html__( 'Show Rating', 'venus-slider' ),
				'label' => esc_html__( 'Show Rating.', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show product rating.', 'venus-slider' ),
				'std'   => 'on'
			) );
			$this->form->checkbox( array(
				'id'    => '_product_price',
				'name'  => esc_html__( 'Show Price', 'venus-slider' ),
				'label' => esc_html__( 'Show Price.', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show product price.', 'venus-slider' ),
				'std'   => 'on'
			) );
			$this->form->checkbox( array(
				'id'    => '_product_cart_button',
				'name'  => esc_html__( 'Show Cart Button', 'venus-slider' ),
				'label' => esc_html__( 'Show Cart Button.', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show product add to cart button.', 'venus-slider' ),
				'std'   => 'on'
			) );
			$this->form->checkbox( array(
				'id'    => '_product_onsale',
				'name'  => esc_html__( 'Show Sale Tag', 'venus-slider' ),
				'label' => esc_html__( 'Show Sale Tag', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show product sale tag for onsale products.', 'venus-slider' ),
				'std'   => 'on'
			) );
			$this->form->checkbox( array(
				'id'    => '_product_wishlist',
				'name'  => esc_html__( 'Show Wishlist Button', 'venus-slider' ),
				'label' => esc_html__( 'Show Wishlist Button', 'venus-slider' ),
				'std'   => 'off',
				'desc'  => sprintf( esc_html__( 'Check to show wishlist button. This feature needs %s plugin to be installed.', 'venus-slider' ), sprintf( '<a href="https://wordpress.org/plugins/yith-woocommerce-wishlist/" target="_blank" >%s</a>', __( 'YITH WooCommerce Wishlist', 'venus-slider' ) ) ),
			) );
			$this->form->checkbox( array(
				'id'    => '_product_quick_view',
				'name'  => esc_html__( 'Show Quick View', 'venus-slider' ),
				'label' => esc_html__( 'Show Quick View', 'venus-slider' ),
				'desc'  => esc_html__( 'Check to show quick view button.', 'venus-slider' ),
				'std'   => 'on'
			) );
			$this->form->color( array(
				'id'   => '_product_title_color',
				'type' => 'color',
				'name' => esc_html__( 'Title Color', 'venus-slider' ),
				'desc' => esc_html__( 'Pick a color for product title. This color will also apply to sale tag and price.', 'venus-slider' ),
				'std'  => '#333333'
			) );
			$this->form->color( array(
				'id'   => '_product_button_bg_color',
				'type' => 'color',
				'name' => esc_html__( 'Button Background Color', 'venus-slider' ),
				'desc' => esc_html__( 'Pick a color for button background color. This color will also apply to product rating.', 'venus-slider' ),
				'std'  => '#96588a'
			) );
			$this->form->color( array(
				'id'   => '_product_button_text_color',
				'type' => 'color',
				'name' => esc_html__( 'Button Text Color', 'venus-slider' ),
				'desc' => esc_html__( 'Pick a color for button text color.', 'venus-slider' ),
				'std'  => '#f1f1f1'
			) );
			?>
        </div>
    </div>
</div>