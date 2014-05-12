<?php
/*
Template Name: Full Page
*/
?>

<?php get_header(); ?>

	<div id="sp-main-body-wrapper">	
		<div class="container">
			
			<?php while ( have_posts() ) : the_post(); ?>
			
			<!-- <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content clearfix">
					
					<?php	the_content();	?>
					
				</div><!-- .entry-content -->
			<!-- </article> --> 
			
			<?php endwhile; ?>

			<?php
// The Query
query_posts( array ( 'category_name' => 'blog', 'posts_per_page' => -1 ) );
?>

	<div class="blog-wrapper">
		<h3>From Our Blog</h3>
		<h1>Beauty tips</h1>
		<ul class="bxslider">
		    <?php
			// The Loop
			while ( have_posts() ) : the_post();?>
				<li>
					<div class="left-content">
						<h1><?php echo  the_title() ?></h1>
						<p class="blog-content"><?php echo get_excerpt(230); ?></p>
						<a href="<?php the_permalink()?>" class="read-more"><?php the_title_limit( 20, '...'); ?></a>
					</div>
					<div class="right-content">
					<?php
						if ( has_post_thumbnail() ) {
						    the_post_thumbnail();
						}
					?>	
					</div>
				</li>
			<?php endwhile; ?>
			<?php
			// Reset Query
			wp_reset_query();
			?>
		</ul>
	</div>


	<div class="latest-blog">
	<?php
		$args = array( 'numberposts' => 1 , 'category_name' => 'themes' );
		$lastposts = get_posts( $args );
		foreach($lastposts as $post) : setup_postdata($post); ?>
			<?php //the_content(); ?>
			<?php
				if ( has_post_thumbnail() ) {
					//the_post_thumbnail();
					the_post_thumbnail('full'); 
				}
			?>
			<h2 class="title=p"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>	
			<a class="shop">Shop Now</a>
		<?php endforeach; ?>

	</div>


	<section id="recent">

    <ul class="row-fluid bxslider">

        <?php
            $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 4, 'orderby' =>'date','order' => 'DESC' );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

                    <li class="span3">    

                        <a class="product-item" id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

                            <?php if (has_post_thumbnail( $loop->post->ID )) 
                            echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); 
                            else 
                            echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="65px" height="115px" />'; ?>

                            

                        </a>
                        <div class="product-content">
                        		<h3><?php the_title(); ?></h3>
                        	   	<span class="price"><?php echo $product->get_price_html(); ?></span>
                        	   	<p class="pro-description"><?php the_excerpt()?></p>
                        	   	<a class="more-view">see more</a>
                        </div>

                        <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                    </li><!-- /span3 -->
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>

    </ul><!-- /row-fluid -->
</section><!-- /recent -->
<section class="last-session">
	<h3 class="title-laste">SEE WHO<i class="icon-wishlist"></i>  'S OUR LASHES</h3>
	<ul class="bxsliderl">
	<?php
		$args = array( 'numberposts' => 4 , 'category_name' => 'uncategorized' );
		$lastposts = get_posts( $args );
		foreach($lastposts as $post) : setup_postdata($post); ?>
		<li>
			<div class="left-image">
					<?php
						if ( has_post_thumbnail() ) {
						    the_post_thumbnail('full');
						}
					?>	
			</div>
			<div class="right-content">
				<div class="content-p"><?php the_content(); ?></div>
				<div class="content-last"><?php the_excerpt() ?></div>
			</div>
		</li>
		<?php endforeach; ?>
</section>

		</div><!-- #content -->
	</div>

<?php get_footer(); ?>
