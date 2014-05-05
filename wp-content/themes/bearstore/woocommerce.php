<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
get_header(); ?>
<?php
$get_layout = isset($_GET['layout']) ? intval($_GET['layout']) : 0; 
if($get_layout) {
	$layout = $get_layout;
}else {
	$layout = Helix::Param('woo_page_layout');
}
?>

	<div id="sp-main-body-wrapper">	
		
	
			<div class="container">	
			<?php Helix::addFeatures('breadcrumbs'); ?>
			</div>
		</div>
		
		<div class="container" id="content">
	
			<div class="row-fluid">
				<?php if($layout==2 && !is_singular( 'product')) { ?>
				<?php if (Helix::hasWidgets(array('shop_slidebar'))) : ?>
					<aside id="leftsidebar" class="span<?php echo Helix::Param('left_sidebar_width'); ?>">
						<?php Helix::addWidgets(array('shop_slidebar')); ?>
					</aside>
				<?php endif; ?>
				<?php } ?>
				<div class="span<?php echo ($layout==1 || is_singular( 'product')) ? '12' : '9'; ?>">
					
					<div id="primary">
						<div role="main">
						<?php woocommerce_content(); ?>
			
						</div><!-- #content -->
					</div><!-- #primary -->
				</div><!--End Main-->
			<?php if($layout==3 && !is_singular( 'product')) { ?>
			<?php if (Helix::hasWidgets(array('shop_slidebar'))) : ?>
				<aside id="rightsidebar" class="span<?php echo Helix::Param('right_sidebar_width'); ?>">
					<?php Helix::addWidgets(array('shop_slidebar')); ?>
				</aside>
			<?php endif; ?>
			<?php } ?>
			</div>

		</div><!-- #content -->
	</div>

<?php get_footer(); ?>