<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( $attachment_ids ) {
	?>
	<div class="thumb-images flexslider"><ul class="slides"><?php

		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'thumb-item' );

			/*if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';*/

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><a href="%s" class="%s nolightbox" title="%s" >%s</a></li>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}

	?></ul></div>
	<script type="text/javascript">
				  
    jQuery(window).load(function(){
      jQuery('.thumb-images').flexslider({
        animation: "slide",
        itemWidth: 161,
        itemMargin: 0,
        animationLoop: false,
		controlNav: false,
		directionNav: true,
        prevText: "<i class=\"icon-left-open-big\"></i>",
        nextText: "<i class=\"icon-right-open-big\"></i>" 
      });
          	jQuery("div.product").removeClass("span3");
    });

	// Thumbs click action
	jQuery(document).ready(function(){
		jQuery(".thumb-item").each(function(){
			jQuery(this).click(function(){
				var first_image_selector = jQuery('.images a.zoom');
				var get_original_link_of_image = jQuery(this).attr("href");
				first_image_selector.find('.wp-post-image').attr("src", get_original_link_of_image);
				first_image_selector.find('.zoomImg').attr("src", get_original_link_of_image);
				first_image_selector.attr("href",get_original_link_of_image);
				return!1
			});
	
		});
	});

  </script>
	<?php
}