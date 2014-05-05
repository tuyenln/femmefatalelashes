<?php
/*
Template Name: Full Page
*/
?>

<?php get_header(); ?>

	<div id="sp-main-body-wrapper">	
		<div class="container">
			
			<?php while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content clearfix">
					
					<?php	the_content();	?>
					
				</div><!-- .entry-content -->
			</article>
			
			<?php endwhile; ?>

			<?php
// The Query
query_posts( array ( 'category_name' => 'blog', 'posts_per_page' => -1 ) );
?>
<h3>From Our Blog</h3>
<h1>Beauty tips</h1>
	<div class="flexslider">
		<ul class="slides">
		    <?php
			// The Loop
			while ( have_posts() ) : the_post();
				echo '<li>';
					echo '<div class="left-content">';
					echo '<h1>' . the_title() . '</h1>';
					echo '<div class="blog-content">' . the_content() .'</div>';
					echo '</div>';
					echo '<div class="right-content">';
						if ( has_post_thumbnail() ) {
						    the_post_thumbnail();
						}
				echo '</div>';
				echo '</li>';
			endwhile; ?>
			<?php
			// Reset Query
			wp_reset_query();
			?>
		</ul>
	</div>

		</div><!-- #content -->
	</div>

<?php get_footer(); ?>
