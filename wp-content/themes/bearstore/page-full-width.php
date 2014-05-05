<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>

	<div id="sp-main-body-wrapper">	
        <div class="page_full_width">

			<?php while ( have_posts() ) : the_post(); ?>
        
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	            <div class="entry-content clearfix">

					<?php the_content(); ?>

	            </div><!-- .entry-content -->
			</article>

		    <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->
	</div>

<?php get_footer(); ?>