<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<h1 itemprop="name" class="name"><?php the_title(); ?></h1>
<?php

global $woocommerce, $product, $post;

if (is_singular('product')) {

if ( comments_open() ) {
	
	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$count = $product->get_rating_count();

		if ( $count > 0 ) {

			$average = $product->get_average_rating();

			echo '<div class="ratings">';

			echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'woocommerce' ), $average ).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';

			echo '<p class="rating-links"><a onclick="window.location.hash=\'tab-description\';" data-toggle="tab" href="#tab-reviews">'.sprintf( _n('%s Review', '%s Reviews', $count, 'woocommerce'), '<span itemprop="ratingCount" class="count">'.$count.'</span>' ).'</a> <span class="separator">|</span> <a href="#review_form" class="inline show_review_form" title="' . __( 'Add Your Review', 'woocommerce' ) . '">' . __( 'Add Your Review', 'woocommerce' ) . '</a></p>';

			echo '</div>';

		} else {

			echo '<div class="ratings">'.__( '<a href="#review_form" class="inline show_review_form">Be the first to review this product</a>', 'woocommerce' ).'</div>';

		}

	}

}

?>
<ul class="add-to-links"><li><?php do_action('nova_wishlist_details_link'); ?></li><li><?php do_action('nova_compare_details_link'); ?></li></ul>
<?php } ?>