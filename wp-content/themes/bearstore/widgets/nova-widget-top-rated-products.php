<?php
/**
 * Top Rated Products Widget
 *
 * Gets and displays top rated products in an unordered list
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	1.6.4
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Nova_Widget_Top_Rated_Products extends WP_Widget {

	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	/**
	 * constructor
	 *
	 * @access public
	 * @return void
	 */
	function Nova_Widget_Top_Rated_Products() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'woocommerce top_rated_products';
		$this->woo_widget_description = __( 'Display a list of top rated products on your site.', 'woocommerce' );
		$this->woo_widget_idbase = 'nova_top_rated_products';
		$this->woo_widget_name = __( 'Nova Top Rated Products', 'woocommerce' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget('top-rated-products', $this->woo_widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget($args, $instance) {
		global $woocommerce;

		$cache = wp_cache_get('top_rated_products', 'widget');

		if ( !is_array($cache) ) $cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Top Rated', 'woocommerce' ) : $instance['title'], $instance, $this->id_base);

		if ( !$number = (int) $instance['number'] ) $number = 10;
		else if ( $number < 1 ) $number = 1;
		else if ( $number > 15 ) $number = 15;

		add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );

		$query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

		$query_args['meta_query'] = $woocommerce->query->get_meta_query();

		$top_rated_posts = new WP_Query( $query_args );

		if ($top_rated_posts->have_posts()) :

			echo $before_widget;

			if ( $title ) echo $before_title . $title ."<i class=\"icon-right-open-big\"></i>". $after_title;
				?>
	<script type="text/javascript">
				  
    jQuery(window).load(function(){
    	var width_doc = jQuery(document).width();
    	if(width_doc >960){
	      jQuery('.top-rateds').flexslider({
	        animation: "slide",
	        itemWidth: 212,
	        itemMargin: 18,
	        animationLoop: true,
			controlNav: true,
			directionNav: false,
	        prevText: "<i class=\"icon-angle-left\"></i>",
	        nextText: "<i class=\"icon-angle-right\"></i>" 
	      });
	    }
	  if(width_doc <900){
	      jQuery('.top-rateds').flexslider({
	        animation: "slide",
	        itemWidth: 212,
	        itemMargin: 18,
	        animationLoop: true,
			controlNav: false,
			directionNav: false,
	        prevText: "<i class=\"icon-angle-left\"></i>",
	        nextText: "<i class=\"icon-angle-right\"></i>" 
	      });
	  }
    });
  </script>
			<div class="top-rateds flexslider products-list-home">
				<ul class="slides">
					<?php while ($top_rated_posts->have_posts()) : $top_rated_posts->the_post(); global $product;
					?>
					<li><a href="<?php echo esc_url( get_permalink( $top_rated_posts->post->ID ) ); ?>" title="<?php echo esc_attr($top_rated_posts->post->post_title ? $top_rated_posts->post->post_title : $top_rated_posts->post->ID); ?>">
						<?php echo ( has_post_thumbnail() ? get_the_post_thumbnail( $top_rated_posts->post->ID, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) ); ?>
						<?php if ( $top_rated_posts->post->post_title ) echo get_the_title( $top_rated_posts->post->ID ); else echo $top_rated_posts->post->ID; ?>
					</a> <?php echo $product->get_price_html(); ?><?php echo $product->get_rating_html(); ?></li>

					<?php endwhile; ?>
				</ul></div>
				<?php
			echo $after_widget;
		endif;

		wp_reset_query();
		remove_filter( 'posts_clauses', array( $woocommerce->query, 'order_by_rating_post_clauses' ) );

		$content = ob_get_clean();

		if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

		echo $content;

		wp_cache_set('top_rated_products', $cache, 'widget');
	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['top_rated_products']) ) delete_option('top_rated_products');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('top_rated_products', 'widget');
	}

	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'woocommerce' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of products to show:', 'woocommerce' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>
<?php
	}

}