<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post,$woocommerce, $product,$data;

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

	$meta_fields = get_post_meta($post->ID, 'zn_meta_elements', true);
	$meta_fields = maybe_unserialize( $meta_fields );

?>


	<?php if ( has_post_thumbnail() ) : ?>

		<div class="images product-gallery">

			<div class="big_image product-images">
				<?php echo $on_sale;?>
				<?php echo $new_label;?>
				<a class="woocommerce-main-image nolightbox zoom" itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" rel="prettyPhoto[product-gallery]" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', '' ) ) ?></a>

			</div>
			
			<?php
				
				if ( !empty ( $meta_fields['woo_image_gallery'] ) && is_array( $meta_fields['woo_image_gallery'] ) ) {

					echo '<div class="thumb-images flexslider">';
					echo '<ul class="slides">';
					
						foreach ( $meta_fields['woo_image_gallery'] as $simage ) {
						
							$image = '';
							
							if ( !empty ( $simage['woo_single_image'] ) ) {
								$image = vt_resize( '', $simage['woo_single_image']  , 50,'50' , true );
								echo '<li><a href="'.$simage['woo_single_image'].'" rel="prettyPhoto[product-gallery]"><img src="'.$image['url'].'" alt="" /></a></li>';
							}
							
							
						}
					
					echo '</ul>';
					echo '</div>';
				
					/*echo '<ul class="thumbss">';
					
						foreach ( $meta_fields['woo_image_gallery'] as $simage ) {
						
							$image = '';
							
							if ( !empty ( $simage['woo_single_image'] ) ) {
								$image = vt_resize( '', $simage['woo_single_image']  , 50,'50' , true );
								echo '<li><a href="'.$simage['woo_single_image'].'" rel="prettyPhoto[product-gallery]"><img src="'.$image['url'].'" alt="" /></a></li>';
							}
							
							
						}
					
					echo '</ul>';*/
					

				}
				 do_action('woocommerce_product_thumbnails');
			?>

			<div class="clear"></div>
		</div>

	
	<?php else : ?>
		
			<div class="product-gallery">
				<div class="zn_badge_container">
					<?php echo $on_sale;?>
					<?php echo $new_badge;?>
				</div>
				<div class="big_image">
					<img src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />
				<div class="clear"></div>
				</div>
			</div>	
		
	<?php endif; ?>

	

