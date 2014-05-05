<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop, $has_sidebar;

$related = $product->get_related();

if ( sizeof($related) == 0 ) return;

$content_css = 'span12';
if ( $has_sidebar ) {
	$content_css = 'span9';
}



$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>
<div class="related_products <?php echo $content_css;?>">
	<div class="related products">

		<h3><?php _e('Related Products', 'woocommerce'); ?></h3>

	<script type="text/javascript">
				  
    jQuery(window).load(function(){
      jQuery('.related-products').flexslider({
        animation: "slide",
        itemWidth: 180,
        itemMargin: 18,
        animationLoop: true,
		controlNav: false,
		directionNav: true,
        prevText: "<i class=\"icon-left-open-big\"></i>",
        nextText: "<i class=\"icon-right-open-big\"></i>" 
      });
          	jQuery("div.product").removeClass("span3");
    });



  </script>

		<div class="related-products flexslider products-list-home">
                        <ul class="slides">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						<li>


				<?php woocommerce_get_template_part( 'content', 'product' ); ?>


						</li>
			<?php endwhile; // end of the loop. ?>
			
						</ul>
		</div>

	</div>
</div>

<?php endif;

wp_reset_postdata();
