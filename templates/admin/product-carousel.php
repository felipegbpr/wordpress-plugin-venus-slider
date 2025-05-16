<div data-id="open" id="section_product_query" class="shapla-toggle shapla-toggle--stroke"
    style="display: <?php echo $slide_type != 'product-carousel' ? 'none' : 'block'; ?>">
    <span class="shapla-toggle-title">
        <?php _e( 'Product Query', 'venus-slider' ); ?>
    </span>
    <div class="shapla-toggle-inner">
        <div>
            <div class="shapla-toggle-content">
                <?php 
                $this->form->select( array (
                    'id'       => '_product_query_type',
                    'name'     => __( 'Query Type', 'venus-slider' ),
                    'std'      => 'query_product',
                    'options'  => array(
                        'query_product'       => __( 'Query Products', 'venus-slider' ),
                        'product_categories'  => __( 'Products Categories', 'venus-slider' ),
                        'product_tags'        => __( 'Products Tags', 'venus-slider' ),
                        'specific_products'   => __( 'Specific Products', 'venus-slider' ),
                    ),
                ) );
                $this->form->select( array (
                    'id'       => '_product_query',
                    'name'     => __( 'Choose Query', 'venus-slider' ),
                    'std'      => 'featured',
                    'options'  => array(
                        'featured'            => __( 'Featured Products', 'venus-slider' ),
                        'recent'              => __( 'Recent Products', 'venus-slider' ),
                        'sale'                => __( 'Sale Products', 'venus-slider' ),
                        'best_selling'        => __( 'Best-Selling Products', 'venus-slider' ),
                        'top_rated'           => __( 'Top Rated Products', 'venus-slider' ),
                    ),
                ) );
                $this->form->post_terms( array( 
                    'id'       => '_product_categories',
                    'taxonomy' => '_product_cat',
                    'multiple' => true,
                    'name'     => __( 'Product Categories', 'venus-slider' ),
                    'desc'     => __( 'Show products associated with selected categories.', 'venus-slider' ),
                ) );
                $this->form->post_terms( array( 
                    'id'       => '_product_tags',
                    'taxonomy' => '_product_tag',
                    'multiple' => true,
                    'name'     => __( 'Product Tags', 'venus-slider' ),
                    'desc'     => __( 'Show products associated with selected tags.', 'venus-slider' ),
                ) );
                $this->form->post_list( array( 
                    'id'       => '_product_in',
                    'taxonomy' => 'product',
                    'multiple' => true,
                    'name'     => __( 'Specific products', 'venus-slider' ),
                    'desc'     => __( 'Select products that you want to show as slider.', 'venus-slider' ),
                ) );
                $this->form->number( array( 
                    'id'       => '_products_per_page',
                    'name'     => __( 'Products per page', 'venus-slider' ),
                    'std'      => 12,
                    'desc'     => __( 'How many products you want to show on carousel slide.', 'venus-slider' ),
                ) );
                $this->form->checkbox( array( 
                    'id'        => '_product_title',
                    'name'      => __( 'Show Title',  'venus-slider' ),
                    'label'     => __( 'Show Title.', 'venus-slider' ),
                    'desc'      => __( 'Check to show product title.', 'venus-slider' ),
                    'std'       => 'on'
                ) );
                $this->form->checkbox( array( 
                    'id'        => '_product_rating',
                    'name'      => __( 'Show Rating',  'venus-slider' ),
                    'label'     => __( 'Show Rating.', 'venus-slider' ),
                    'desc'      => __( 'Check to show product rating.', 'venus-slider' ),
                    'std'       => 'on'
                ) );
                $this->form->checkbox( array( 
                    'id'        => '_product_price',
                    'name'      => __( 'Show Price',  'venus-slider' ),
                    'label'     => __( 'Show Price.', 'venus-slider' ),
                    'desc'      => __( 'Check to show product price.', 'venus-slider' ),
                    'std'       => 'on'
                ) );
                $this->form->checkbox( array( 
                    'id'        => '_product_cart_button',
                    'name'      => __( 'Show Cart Button', 'venus-slider' ),
                    'label'     => __( 'Show Cart Button.', 'venus-slider' ),
                    'desc'      => __( 'Check to show product add to cart button.', 'venus-slider' ),
                    'std'       => 'on'
                ) );
                $this->form->checkbox( array( 
                    'id'        => '_product_onsale',
                    'name'      => __( 'Show Sale Tag', 'venus-slider' ),
                    'label'     => __( 'Show Sale Tag', 'venus-slider' ),
                    'desc'      => __( 'Check to show product sale tag for onsale products.', 'venus-slider' ),
                    'std'       => 'on'
                ) );
                $this->form->checkbox( array( 
                    'id'        => '_product_wishlist',
                    'name'      => __( 'Show Wishlist Button', 'venus-slider' ),
                    'label'     => __( 'Show Wishlist Button', 'venus-slider' ),
                    'desc'      => __( 'Check to show product sale tag for onsale products.', 'venus-slider' ),
                    'std'       => 'off',
                    'desc'      => sprintf( esc_html__( 'Check to show wishlist button. This feature needs %s plugin to be installed.', 'venus-slider' ), sprintf( '<a href="https://wordpress.org/plugins/yith-woocommerce-wishlist/" target="_blank" >%s</a>', __(  'YITH WooCommerce Wishlist', 'venus-slider' ) ) )
                ) );
                $this->form->checkbox( array( 
                    'id'        => '_product_quick_view',
                    'name'      => __( 'Show Quick View', 'venus-slider' ),
                    'label'     => __( 'Show Quick View', 'venus-slider' ),
                    'desc'      => __( 'Check to show product sale tag for onsale products.', 'venus-slider' ),
                    'desc'      => __( 'Check to show quick view button.',  'venus-slider' ),
                    'std'       => 'on'
                ) );
                $this->form->color( array( 
                    'id'        => '_product_title_color',
                    'type'      => 'color',
                    'name'      => __( 'Title Color', 'venus-slider' ),
                    'desc'      => __( 'Pick a color for product title. This color will also apply to sale tag and price.', 'venus-slider' ),
                    'std'       => '#333333'
                ) );
                $this->form->color( array( 
                    'id'        => '_product_button_bg_color',
                    'type'      => 'color',
                    'name'      => __( 'Button Background Color', 'venus-slider' ),
                    'desc'      => __( 'Pick a color for button background color. This color will also apply to product rating.', 'venus-slider' ),
                    'std'       => '#96588a'
                ) );
                $this->form->color( array( 
                    'id'        => '_product_button_text_color',
                    'type'      => 'color',
                    'name'      => __( 'Button Text Color', 'venus-slider' ),
                    'desc'      => __( 'Pick a color for button text color.', 'venus-slider' ),
                    'std'       => '#f1f1f1'
                ) );
                ?>
            </div>
        </div>
    </div>
</div>