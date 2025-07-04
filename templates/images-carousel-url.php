<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$_image_target             = get_post_meta( $id, '_image_target', true );
$_image_target             = empty( $_image_target) ? '_self' : $_image_target;
$_image_size               = get_post_meta( $id, '_image_size', true );
$_nav_color                = get_post_meta( $id, '_nav_color', true );
$_nav_active_color         = get_post_meta( $id, '_nav_active_color', true );
$_lazy_load_image          = get_post_meta( $id, '_lazy_load_image', true );
$_show_attachment_title    = get_post_meta( $id, '_show_attachment_title', true );
$_show_attachment_caption  = get_post_meta( $id, '_show_attachment_caption', true );
$_images_urls               = get_post_meta( $id, '_images_urls', true );
?>
<style>
    #id-<?php echo $id; ?> .owl-dots .owl-dot span {
        background-color: <?php echo $_nav_color; ?>
    }

    #id-<?php echo $id; ?> .owl-dots .owl-dot.active span,
    #id-<?php echo $id; ?> .owl-dots .owl-dot:hover span {
        background-color: <?php echo $_nav_active_color; ?>
    }

    #id-<?php echo $id; ?> .venus-slider-nav-icon {
        fill: <?php echo $_nav_color; ?>;
    }

    #id-<?php echo $id; ?> .venus-slider-nav-icon:hover {
        fill: <?php echo $_nav_active_color; ?>;
    }
</style>
<div <?php echo join(" ", $this->carousel_options( $id ) ); ?>>
    <?php 
    foreach ( $_images_urls as $imageInfo ):
        
        echo '<div class="venus-slider__item">';

        $title   = sprintf( '<h4 class="title">%1$s</h4>', $imageInfo['title'] );
        $caption = sprintf( '<p class="caption">%1$s</p>', $imageInfo['caption'] );

        if ( $_show_attachment_title == 'on' && $_show_attachment_caption == 'on' ) {

            $full_caption = sprintf( '<div class="venus-slider__caption">%1$s%2$s</div>', $title, $caption );

        } elseif ( $_show_attachment_title == 'on' ) {

            $full_caption = sprintf( '<div class="venus-slider__caption">%1$s%2$s</div>', $title );

        } elseif ( $_show_attachment_caption == 'on' ) {

            $full_caption = sprintf( '<div class="venus-slider__caption">%1$s%2$s</div>', $caption );

        } else {
            $full_caption = '';
        }

        if ( $_lazy_load_image == 'on' ) {

            $image  = sprintf( '<img class="owl-lazy" data-src="%1$s" alt="%2$s" />', $imageInfo['url'], $imageInfo['alt'] );

        } else {
            $image  = sprintf( '<img src="%1$s" alt="%2$s" />', $imageInfo['url'], $imageInfo['alt'] );
        }

        if ( filter_var( $imageInfo['link_url'], FILTER_VALIDATE_URL ) ) {

            echo sprintf( '<a href="%1$s" target="%4$s">%2$s %3$s</a>', $imageInfo['link_url'], $image, $full_caption, $_image_target );

        } else {

            echo $image . $full_caption;

        }

        echo '</div>';
    endforeach;
    ?>    
</div>