<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<div class="col-main">
<div class="row-fluid top-empty">
	
	
<div class="span4"></div>
<div class="span8">
	
<div class="page-title">
	<div class="icon-top">
		<i class="icon-emo-unhappy"></i>
	</div>
    <h1 class="entry-title page-header">Shopping Cart is Empty</h1>
</div>
<div class="cart-empty">
<p><?php _e('Your cart is currently empty.', 'woocommerce') ?></p>

<?php do_action('woocommerce_cart_is_empty'); ?>

<p><a href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e('Continue Shopping', 'woocommerce') ?></a></p>
</div>
</div>

</div>
</div>