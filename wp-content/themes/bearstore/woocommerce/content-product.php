<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
/*if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}*/

// Ensure visibilty
if ( ! $product->is_visible() ) {
	return;
}

?>
				

	<?php //do_action( 'woocommerce_before_shop_loop_item' ); 


// Increase loop count
$woocommerce_loop['loop']++;

$get_col = isset($_GET['col']) ? intval($_GET['col']) : 0; 
if($get_col) {
	$col = $get_col;
}else {
	$col = Helix::Param('woo_product_columns');
}
?>
<div class="span<?php



	if ($col==3) echo '4';
	if ($col==4) echo '3';
	if ($col==5) echo '5col';
	if ($col==6) echo '2'; 
?> product">
<?php

	if ( ! $product->is_in_stock() ) { 

	$zlink = '<a href="'. apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ).'" class="">'. apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'woocommerce' ) ).'</a>';

	}
	else { ?>

	<?php
		if ( Helix::Param('woo_catalog_mode') ) {
			$zlink  = '';
		} else {
			$link 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
			$label 	= apply_filters( 'add_to_cart_text', __('<i class="icon-bag"></i>', 'woocommerce') );
			$zlink = '<a href="'. $link .'" rel="nofollow" data-product_id="'.$product->id.'" class="add_to_cart_button product_type_overhead">'. $label.'</a>';
		}

	}
		
	/*--------------------------------------------------------------------------------------------------
		New BADGE
	--------------------------------------------------------------------------------------------------*/
		global $data;
		$new_label = '';
		if (true) {
		
			$now = time();
			$diff = (get_the_time('U') > $now) ? get_the_time('U') - $now : $now - get_the_time('U');
			$val = floor($diff/86400);
			$days = floor(get_the_time('U')/(86400));
			
			if ( Helix::Param('woo_new_badge_days') >= $val ) {
				$new_label = '<div class="nova-product-label nova-new-label">'.__('New').'!</div>';
			}
	
		} 
/*--------------------------------------------------------------------------------------------------
	SALE BADGE
--------------------------------------------------------------------------------------------------*/
	$on_sale = '';
	if ($product->is_on_sale()) : 

		$on_sale = '<div class="nova-product-label nova-sale-label">'.__('Sale').'!</div>'; 

	endif;		
		
	?>

		<div class="product-list-item ">
			<span class="hover"></span>
			<div class="product-images">
				<?php echo $new_label;?>
				<?php echo $on_sale;?>
				<div class="quickview-box">
				<a class="hs-rsp-popup hiddendiv quickview_small" href="#product-<?php echo $product->id; ?>" data-id="<?php echo $product->id; ?>" data-popupwidth="760" data-popupheight="460">Quick View</a> 
				</div>
				<a href="<?php echo get_permalink();?>">
				<?php
				
     if(Helix::Param('woo_img_hover')){
      echo '<div class="front">
     ' . ( has_post_thumbnail() ? get_the_post_thumbnail( $product->id, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) ) . '
     </div>';
     					$attachment_ids = $product->get_gallery_attachment_ids();
     					$i=1;
 						foreach ( $attachment_ids as $simage ) {
							if ($i==1) {
								$image       = wp_get_attachment_image( $simage, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ) );
								echo '<div class="product-img-additional back">'.$image.'</div>';
							}
							$i++;
							
						}  
	}else {
		echo ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) );
	}
				
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
				//do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
				</a>
				

			<div class="descriptions-hidden">		
				<div class="quick-act">            
					<?php
					echo $zlink;
					do_action('nova_compare_link');
					do_action('nova_wishlist_link');
					?> 
				</div>
			</div>
				
			</div>
			<h3 class="nova-product-title"><a href="<?php echo get_permalink();?>"><?php the_title(); ?></a></h3>
			<?php if ($price_html = $product->get_price_html()) : ?>
				<div class="price"><?php echo $price_html; ?></div>
			<?php endif; ?>
			<?php if ($rating_html = $product->get_rating_html()) : ?>
				<div class="rating"><?php echo $rating_html; ?></div>
			<?php endif; ?>

			<div class="details fixclear">
				
					<?php
						/**
						 * woocommerce_after_shop_loop_item_title hook
						 */
						//do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
				<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>

			</div>
			<?php 
				if ( !Helix::Param('woo_catalog_mode') ) {
			?>			
			<div class="act-box"><a class="btn-cart button" href="<?php echo esc_url( $product->add_to_cart_url() ); ?>">ADD TO CART</a></div>
			<?php } ?>
			<div id="product-<?php echo $product->id; ?>" style="display:none">
				<div class="images">
				<?php echo ( has_post_thumbnail() ? get_the_post_thumbnail( $product->id, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) ) ; ?>
				</div>
				<div class="summary entry-summary">
					<?php
						/**
						 * woocommerce_single_product_summary hook
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div>
		</div><!-- end product-item -->
	




	<?php //do_action( 'woocommerce_after_shop_loop_item' ); ?>

</div>

<?php
	global $has_sidebar;
	/*if ( $has_sidebar ) {
		$num_col = 3;
	}
	else {
		$num_col = 4;
	}*/

	$num_col = $col ? $col : 4;
	if ( $woocommerce_loop['loop'] % $num_col == 0 ) {
		echo '</div><div class="row">';
	}
?>