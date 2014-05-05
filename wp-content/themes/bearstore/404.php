<?php
/**
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

<div id="page-404" class="clearfix">
	<article id="error-page">
		<div>
			<h1 class="error-code"><?php _e( '404', _THEME ); ?></h1>
			<h2 class="error-code2"><?php _e( 'Oops!', _THEME ); ?></h2>
			<p class="error-message">
				<?php _e( 'The page you are looking for does not exist.', _THEME ); ?><br />
				<?php _e( 'Return to the', _THEME ); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('home page!', _THEME); ?></a>
			</p>
		</div>
	</article>
</div>

		</div><!-- #content -->
	</div>

<?php get_footer(); ?>