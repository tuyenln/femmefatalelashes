<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce; ?>

<?php $woocommerce->show_messages(); ?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
<div class="col-main">
<div class="account-login" id="form_login">
<div class="col2-set">

	<div class="col-2 registered-users">

<?php endif; ?>
		<div class="content">
		<h2><?php _e('Registered Customers', 'woocommerce'); ?></h2>
		<p>If you have an account with us, please log in.</p>
		<form method="post" action="<?php echo home_url('/wp-login.php'); ?>" class="1login">
		<ul class="form-list">
			<li>
				<label for="email" class="required"><em>*</em> Username</label>
				<div class="input-box">
					<input type="text" name="log" placeholder="<?php _e('Username', _THEME); ?>" value="" id="email" class="input-text required-entry validate-email" title="Username" />
				</div>
			</li>
			<li>
				<label for="pass" class="required"><em>*</em> Password</label>
				<div class="input-box">
					<input type="password" name="pwd" placeholder="<?php _e('Password', _THEME); ?>" class="input-text required-entry validate-password" id="pass" title="Password" />
				</div>
			</li>
			<li>
				<label for="check" class="checkbox"><input type="checkbox"> Remember me</label>
			</li>
		</ul>
		<p class="required">* Required Fields</p>

		<div class="buttons-set">
			<a href="<?php echo esc_url( wp_lostpassword_url( home_url() ) ); ?>" class="f-left">Forgot Your Password?</a>
			<button type="submit" class="button" title="Login" name="login" id="send2"><span><span>Login</span></span></button>
			<input type="hidden" name="redirect_to" value="<?php echo home_url('/my-account'); ?>">
			<input type="hidden" name="testcookie" value="1">
			<?php $woocommerce->nonce_field('login', 'login') ?>
		</div>
		</form>
		</div>

<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>

	</div>

	<div class="col-1 new-users">
		<div class="content">
			<h2>New Customers</h2>
			<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
		</div>  
		<div class="buttons-set">
			<button type="button" title="Create an Account" class="button" onclick="window.location='<?php echo home_url(); ?>/wp-login.php?action=register';"><span><span>Create an Account</span></span></button>
		</div>
	</div>

</div>
</div>
</div>
<?php endif; ?>

<?php do_action('woocommerce_after_customer_login_form'); ?>