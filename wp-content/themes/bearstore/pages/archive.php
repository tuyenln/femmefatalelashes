<?php
/**
 * Template Name: Archive
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
get_header();

?>

	<div id="sp-main-body-wrapper">	
		<div id="breadcrumbs-wrapper">
			<div class="container">	
			<?php Helix::addFeatures('breadcrumbs'); ?>
			</div>
		</div>
	
		<div class="container" id="content">

<div id="archive-page" class="clearfix">

	<div class="entry-header">
		<h1 class="entry-title page-header"><?php the_title(); ?></h1>
		<?php edit_post_link( __( 'Edit', _THEME ) ); ?>
	</div>
	
	<?php the_post(); ?>
	<?php the_content(); ?>
	
	<div class="row-fluid">
		<div class="span12">
			<h3><?php _e('Lastest posts', _THEME); ?></h3>
			<div class="wall">
				<ul>
					<?php
						$posts = get_posts('numberposts=10&offset=0');
						foreach($posts as $post) :
							setup_postdata( $post );
					?>
					<li><p class="sp-blocknumber"><span style="background:#7e7e7e;color:#FFF"><?php echo get_the_time('d M'); ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<h3><?php _e('Categories', _THEME); ?></h3>
			<div class="wall">
				<ul>
					<?php 
						wp_list_categories(array(
							'orderby' => 'name',
							'show_count' => 1,
							'title_li' => ''
						)); 
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="row-fluid">	
		<div class="span12">
			<h3><?php _e('Monthly Archives', _THEME); ?></h3>
			<div class="wall">
				<ul>
					<?php wp_get_archives('type=monthly&show_post_count=1') ?>
				</ul>
			</div>
		</div>
		
	</div>
</div>

		</div><!-- #content -->
	</div>

<?php get_footer(); ?>