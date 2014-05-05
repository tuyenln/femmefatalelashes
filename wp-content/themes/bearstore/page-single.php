<?php
/*
Template Name: Single Page
*/
?>

<?php get_header(); ?>

	<div id="sp-main-body-wrapper">	
		
			<div class="container">	
			<?php Helix::addFeatures('breadcrumbs'); ?>
			</div>
		</div>
		<div class="container">
			
			<?php while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h2 class="entry-title page-header">								
						<?php the_title(); ?>
					</h2>
			
					<?php // Edit Link ?>
					<?php edit_post_link( __( 'Edit', _THEME ) ); ?>
					
				</header>
				<div class="entry-content clearfix">
					<?php	the_content( '', FALSE );	?>
					
				</div><!-- .entry-content -->
			</article>
			
			<?php endwhile; ?>

		</div><!-- #content -->
	</div>	

<?php get_footer(); ?>