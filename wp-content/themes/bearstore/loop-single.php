<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="entry-thumbs">
<?php the_post_thumbnail( 'portfolio-large' ); ?>

</div>

		<header class="entry-header">
			<h1 class="entry-title page-header"><?php the_title(); ?></h1>
			<?php if ( is_sticky() && is_home() && ! is_paged() ) :  //Featured ?>
				<span class="label label-info"><?php _e( 'Featured', _THEME ); ?></span>
			<?php endif; ?>
			<?php edit_post_link( __( 'Edit', _THEME ) ); ?>
		</header>

<div class="post-date"><?php echo " On ". get_the_time("d M, Y"); ?></div>

<div class="entry-content">

<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'bearstore' ), 'after' => '</div>' ) ); ?>
</div><!-- .entry-content -->
 
<div class="entry-utility">
<a href="#"><i class="icon-twitter-rect"></i></a><a href="#"><i class="icon-facebook-rect"></i></a><a href="#"><i class="icon-gplus"></i></a><a href="#"><i class="icon-linkedin-squared"></i></a><a href="#"><i class="icon-vimeo"></i></a>
</div><!-- .entry-utility -->
</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>