<?php
/**
 * Recent Reviews Widget
 *
 * @author 		WooThemes
 * @category 	Widgets
 * @package 	WooCommerce/Widgets
 * @version 	1.6.4
 * @extends 	WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Nova_Widget_Recent_Reviews extends WP_Widget {

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
	function Nova_Widget_Recent_Reviews() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'woocommerce recent_reviews';
		$this->woo_widget_description = __( 'Display a list of your most recent reviews on your site.', 'woocommerce' );
		$this->woo_widget_idbase = 'nova_recent_reviews';
		$this->woo_widget_name = __( 'Nova Recent Reviews', 'woocommerce' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget('recent_reviews', $this->woo_widget_name, $widget_ops);

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
	 function widget( $args, $instance ) {
		global $comments, $comment, $woocommerce;

		$cache = wp_cache_get('recent_reviews', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

 		ob_start();
		extract($args);

 		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Reviews', 'woocommerce' ) : $instance['title'], $instance, $this->id_base);
		if ( ! $number = absint( $instance['number'] ) ) $number = 5;

		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product' ) );

		if ( $comments ) {
			echo $before_widget;
			if ( $title ) echo $before_title . $title ."<i class=\"icon-right-open-big\"></i>". $after_title;
			echo '
	<script type="text/javascript">
				  
    jQuery(window).load(function(){
      var width_doc = jQuery(document).width();
	  if(width_doc >960){
	      jQuery(\'.recent_reviews\').flexslider({
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
	  if(width_doc < 900){
	      jQuery(\'.recent_reviews\').flexslider({
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
			<div class="recent_reviews flexslider products-list-home">
			<ul class="slides">';

			foreach ( (array) $comments as $comment) {

				$_product = get_product( $comment->comment_post_ID );

				$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

				$rating_html = $_product->get_rating_html( $rating );

				echo '<li><a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">';

				echo get_the_post_thumbnail( $_product->id, 'shop_catalog' );

				echo $_product->get_title().'</a>';

				printf( _x( 'by %1$s', 'by comment author', 'woocommerce' ), get_comment_author() ) . '</li>';

				echo $rating_html;

			}

			echo '</ul></div>';
			echo $after_widget;
		}

		$content = ob_get_clean();

		if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

		echo $content;

		wp_cache_set('recent_reviews', $cache, 'widget');
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
		if ( isset($alloptions['recent_reviews']) ) delete_option('recent_reviews');

		return $instance;
	}

	/**
	 * flush_widget_cache function.
	 *
	 * @access public
	 * @return void
	 */
	function flush_widget_cache() {
		wp_cache_delete('recent_reviews', 'widget');
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
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] ) $number = 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'woocommerce' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of products to show:', 'woocommerce' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>
<?php
	}
}