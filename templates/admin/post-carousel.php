<div data-id="open" id="section_post_query" class="shapla-toggle shapla-toggle--stroke"
    style="display: <?php echo $slide_type != 'post-carousel' ? 'none' : 'block' ?> ;">
    <span class="shapla-toggle-title">
        <?php _e( 'Post Query', 'venus-slider' ) ?>
    </span>
    <div class="shapla-toggle-inner">
        <div class="shapla-toggle-content">
            <?php 
            $this->form->select( array( 
                'id'      => '_post_query_type',
                'name'    => __( 'Query Type', 'venus-slider' ),
                'std'     => 'latest_posts',
                'options' => array(
                    'latest_posts'    => __( 'Latest Posts', 'venus-slider' ),
                    'date_range'      => __( 'Date Range', 'venus-slider' ),
                    'post_categories' => __( 'Post Categories', 'venus-slider' ),
                    'post_tags'       => __( 'Post Tags', 'venus-slider' ),
                    'specific_posts'  => __( 'Specific posts', 'venus-slider' ),
                ),
            ) );
            $this->form->date( array( 
                'id'   => '_post_date_after',    
                'name' => __( 'Date from', 'venus-slider' ),    
                'desc' => sprintf( __( 'Example: %s', 'venus-slider' ), date( 'F d, Y', strtotime( '-3 months' ) ) ),    
            ) );
            $this->form->date( array( 
                'id'   => '_post_date_before',    
                'name' => __( 'Date to', 'venus-slider' ),    
                'desc' => sprintf( __( 'Example: %s', 'venus-slider' ), date( 'F d, Y', strtotime( '-7 days' ) ) ),    
            ) );
            $this->form->post_terms( array( 
                'id'       => '_post_categories',    
                'taxonomy' => 'category',    
                'multiple' => true,    
                'name'     => __( 'Post Categories', 'venus-slider' ),    
                'desc'     => sprintf( __( 'Show posts associated with selected categories.', 'venus-slider' ) ),    
            ) );
            $this->form->post_terms( array( 
                'id'       => '_post_tags',    
                'taxonomy' => 'post_tag',    
                'multiple' => true,    
                'name'     => __( 'Post Tags', 'venus-slider' ),    
                'desc'     => sprintf( __( 'Show posts associated with selected tags.', 'venus-slider' ) ),    
            ) );
            $this->form->posts_list( array( 
                'id'       => '_post_in',    
                'multiple' => true,    
                'name'     => __( 'Specific posts', 'venus-slider' ),    
                'desc'     => sprintf( __( 'Select posts that you want to show as slider. Select at least 5 posts', 'venus-slider' ) ),    
            ) );
            $this->form->number( array( 
                'id'       => '_posts_per_page',    
                'name'     => __( 'Posts per page', 'venus-slider' ),    
                'std'      => 12,    
                'desc'     => __( 'How many post you want to show on carousel slide.', 'venus-slider' ),    
            ) );
            $this->form->select( array( 
                'id'      => '_post_order',    
                'name'    => __( 'Order', 'venus-slider' ),    
                'std'     => 'DESC',    
                'options' => array(
                        'ASC'  => __( 'Ascending Order', 'venus-slider' ),
                        'DESC' => __( 'Descending Order', 'venus-slider' ),
                ),    
            ) );
            $this->form->select( array( 
                'id'      => '_post_orderby',    
                'name'    => __( 'Order by', 'venus-slider' ),    
                'std'     => 'ID',    
                'options' => array(
                        'none'          => __( 'No order', 'venus-slider' ),
                        'ID'            => __( 'Post id', 'venus-slider' ),
                        'author'        => __( 'Post author', 'venus-slider' ),
                        'title'         => __( 'Post title', 'venus-slider' ),
                        'modified'      => __( 'Last modified date', 'venus-slider' ),
                        'rand'          => __( 'Random order', 'venus-slider' ),
                        'comment_count' => __( 'Number of comments', 'venus-slider' ),
                ),    
            ) );
            $this->form->number( array( 
                'id'       => '_posts_height',    
                'name'     => __( 'Columns Height', 'venus-slider' ),    
                'std'      => 450,    
                'desc'     => __( 'Enter colums height for posts carousel in numbers. 450 (px) is perfect when columns width is around 300px or higher. Otherwise you need to change it for perfection.', 'venus-slider' ),    
            ) );
            ?>
        </div>
    </div>
</div>