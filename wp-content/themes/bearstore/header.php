<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"  <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"  <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"  <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />
    <meta charset="<?php bloginfo( "charset" ) ?>" />
    <meta name="viewport" content="width=device-width" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <title><?php wp_title(' | ',true,'right'); ?><?php bloginfo('name'); ?></title>
    <?php
		Helix::Header(); //wp_head() included
    ?>
</head>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																										
<body id="sp-wrapper" <?php body_class(); ?>>
<header id="sp-header-wrapper" role="banner">
<!-- 	<div class="top-header-container">
		<div class="container">
			<div class="i-top-links">
				<div class="row-fluid">
						<div class="span6">
<div class="dropdown top-dropdown lang-switcher">
							<p class="label"></p>
							<p class="text"><a href="<?php echo get_site_url(); ?>">Femme Fatale Media</a></li>
							
							</ul>
						</div>	
					</div>
					<div class="top-right-menu span6">
					<?php if ( has_nav_menu( 'top-header-menu' ) ) : ?>
						<?php wp_nav_menu( array( 'theme_location' => 'top-header-menu' ) ); ?>
                        <?php else: ?>
                            Please create and choose top header menu.
                        <?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>
	</div> -->
    <div class="container">	 
	    <div class="row-fluid">	 

			<div class="span8 pagination-left">	 
				<span class="freeOder">Free shipping in all orders</span>
				<?php helix::addFeatures('logo'); ?>	 
			</div>
			<div class="span4 pagination-righted">
				<div class="myaccount"><a href="<?php echo get_site_url(); ?>/my-account">My Account</a></div><?php dynamic_sidebar('cart'); ?>	 
			</div>
			<div class="social"><?php dynamic_sidebar('right'); ?></div>	 
		</div>	
		<div class="row-fluid nova-navigation">	 
			<div id="sp-menu" class="span12">	 
				<?php Helix::addFeatures('menu'); ?>	<?php echo get_product_search()?> 
			</div>	 
		</div>	    
	</div>	
</header>
<?php if (has_visible_widgets( 'fullwidthbanner' ) ) : ?>
<div id="fullwidthbanner-container">
	<div class="fullwidthabnner">
		<?php dynamic_sidebar('fullwidthbanner'); ?>

		<?php while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content clearfix">
					
					<?php	the_content();	?>
					
				</div><!-- .entry-content -->
			</article>
			
			<?php endwhile; ?>
	</div>
</div>
<?php else : ?>
<div class="sp-border">

</div>	
<?php endif; ?>

<section id="sp-main" role="main">