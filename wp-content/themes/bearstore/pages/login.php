<?php
/**
 * Template Name: Login Form
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

get_header(); ?>

	<div id="sp-main-body-wrapper">	
		<div id="breadcrumbs-wrapper">
			<div class="container">	
			<?php Helix::addFeatures('breadcrumbs'); ?>
			</div>
		</div>
	
		<div class="container" id="content">

<div id="page-login" class="row-fluid">

	<header class="entry-header">
		<h1 class="entry-title page-header"><?php the_title(); ?></h1>
		<?php edit_post_link( __( 'Edit', _THEME ) ); ?>
	</header>
	<?php the_post(); ?>
	
	<?php the_content(); ?>
	
	<?php wp_get_current_user(); ?>
		
	<?php if (is_user_logged_in()) { ?>
		<?php _e('Hi', _THEME); ?> <?php echo $current_user->user_login; ?> <br /><br />
		<a class="button-login" href="<?php echo wp_logout_url(home_url()); ?>">Logout</a>
	<?php } else { ?>
		<!-- Login form strat here -->
		<div class="col-main">
			<div class="account-login">
				<form name="loginform" action="<?php echo home_url('/wp-login.php'); ?>" method="post" name="login" id="form-login">
				<div class="col2-set">
				    <div class="col-1 new-users">
						<div class="content">
							<h2>New Customers</h2>
							<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
						</div>  
						<div class="buttons-set">
							<button type="button" title="Create an Account" class="button" onclick="window.location='<?php echo home_url(); ?>/wp-login.php?action=register';"><span><span>Create an Account</span></span></button>
						</div>     
					</div>
					<div class="col-2 registered-users">
						<div class="content">
							<h2>Registered Customers</h2>
							<p>If you have an account with us, please log in.</p>
							<ul class="form-list">
								<li>
									<label for="email" class="required"><em>*</em> Username</label>
									<div class="input-box">
										<input type="text" name="log" placeholder="<?php _e('Username', _THEME); ?>" value="" id="email" class="input-text required-entry validate-email" title="<?php _e('Username', _THEME); ?>" />
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
								<a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword" class="f-left">Forgot Your Password?</a>
								<button type="submit" class="button" title="Login" name="wp-submit" id="send2"><span><span>Login</span></span></button>
								<input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>">
								<input type="hidden" name="testcookie" value="1">
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	<?php } ?>
</div>

		</div><!-- #content -->
	</div>

<?php get_footer(); ?>