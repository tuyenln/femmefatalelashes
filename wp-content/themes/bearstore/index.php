<?php get_header(); ?>

	<div id="sp-main-body-wrapper">	
		
			<div class="container">	
			<?php Helix::addFeatures('breadcrumbs'); ?>
			</div>
		</div>
	
		<div class="container" id="content">
			<div class="row-fluid">
				<?php if (has_visible_widgets( 'left' ) ) : ?>
				<aside id="leftsidebar" class="span<?php echo Helix::Param('left_sidebar_width') ? Helix::Param('left_sidebar_width') : '3'; ?>">
					<?php dynamic_sidebar('left'); ?>
				</aside>
				<?php endif; ?>
				
				<div class="span<?php echo Helix::mainWidth(); ?>">	

					<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h2 class="entry-title page-header">								
								<?php if ( is_sticky() && ! is_paged() ) :  //Featured ?>
								<span class="feature-info"><?php _e( 'Featured', _THEME ); ?></span>
								<?php endif; ?>
							
								<?php if ( is_single() ) : ?>
								<?php the_title(); ?>
								<?php else : ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								<?php endif; ?>
							</h2>
					
							<?php // Edit Link ?>
							<?php edit_post_link( __( 'Edit', _THEME ) ); ?>
							
						</header>
						<?php //if(Helix::content_meta()) : ?>
						<?php //echo Helix::content_meta();//entry meta ?>
						<?php //endif; ?>
						<?php if(!is_page()): ?>
						<?php echo nova_content_meta(); ?>
						<?php endif; ?>
						
						<?php if ( is_search() ) : // Only display Excerpts for Search ?>
							<div class="entry-summary">
								<?php the_excerpt(); ?>
							</div><!-- .entry-summary -->
						<?php else : ?>
						<div class="entry-content clearfix">
						
								<?php if (has_post_thumbnail()) : ?>
									<div class="post-thumbnail">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php  the_post_thumbnail('full'); ?></a>
									</div>
								<?php endif; 
								
								the_content( '', FALSE );
							?>
							
						</div><!-- .entry-content -->
						<?php endif; ?>
						
						<footer>
							
							<?php if ( is_single() ) : ?>
							<?php the_tags('<strong>Tags:</strong> <ul class="entry-tags unstyled"><li>','</li><li>','</li></ul>'); //tags ?>
							
							<?php else : ?>
								<a class="readmore" href="<?php the_permalink(); ?>"><?php echo 'READ MORE'; ?></a> &nbsp; 
							<?php endif; ?>
					
							<?php 
								if ( comments_open() && Helix::Param( Helix::view().'_show_comment_link') ) : 
									comments_popup_link( __( Helix::Param( Helix::view().'_comment_text') ), __( Helix::Param( Helix::view().'_single_comment_text') ), __( Helix::Param( Helix::view().'_multiple_comment_text') ), 'comment-link' );
								endif; // comments_open()
							?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages: ', _THEME ), 'after' => '</div>','link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
							<?php //reverie_page_links(); ?>
						</footer>
						<div class="clearfix">&nbsp;</div>
						<?php if ( is_single() ) : ?>
							<?php comments_template( '', true ); ?>
						<?php endif; ?>
					</article>
					<?php endwhile; ?>

					<?php if ($wp_query->max_num_pages > 1) : ?>
					<nav class="post-nav">
						<ul class="pager">
							<?php if (get_next_posts_link()) : ?>
							<li class="previous"><?php next_posts_link(__('&larr; Older posts', _THEME)); ?></li>
							<?php endif; ?>
							<?php if (get_previous_posts_link()) : ?>
							<li class="next"><?php previous_posts_link(__('Newer posts &rarr;', _THEME)); ?></li>
							<?php endif; ?>
						</ul>
					</nav>
					<?php endif; ?>

				</div><!--End Main-->

				<?php if (has_visible_widgets( 'right' ) ) : ?>
					<aside id="rightsidebar" class="span<?php echo Helix::Param('right_sidebar_width')?Helix::Param('right_sidebar_width'):'3'; ?>">
						<?php dynamic_sidebar('right'); ?>
					</aside>
				<?php endif; ?>
			</div>
		</div><!-- #content -->
	</div>	
	
<?php get_footer(); ?>