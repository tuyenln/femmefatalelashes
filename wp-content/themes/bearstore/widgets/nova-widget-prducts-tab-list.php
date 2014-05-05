<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Nova_Widget_Prducts_Tab_List extends WP_Widget {

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
	function Nova_Widget_Prducts_Tab_List() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'nova-products-tab-list';
		$this->woo_widget_description = __( 'Display a list of your tab products on your site.', 'woocommerce' );
		$this->woo_widget_idbase = 'nova_products_tab_list';
		$this->woo_widget_name = __( 'Nova Products Tab list', 'woocommerce' );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget('nova_products_tab_list', $this->woo_widget_name, $widget_ops);

		add_action( 'save_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_cache' ) );
	}
	/* Featured product */
	function _featured_products($number) {
		global $woocommerce;
		if (!$number)
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
?>

   		<?php $query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

		$query_args['meta_query'] = array();

		$query_args['meta_query'][] = array(
			'key' => '_featured',
			'value' => 'yes'
		);
	    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	    $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();

		$r = new WP_Query($query_args);

		if ($r->have_posts()) : 
echo '
	<script type="text/javascript">
				  
    jQuery(window).load(function(){
      jQuery(\'.featured-products\').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 180,
        itemMargin: 18,
        controlNav: false,
        prevText: "<i class=\"icon-left-open-big\"></i>",
        nextText: "<i class=\"icon-right-open-big\"></i>" 
        
      });
    });
  </script>
<div class="featured-products flexslider products-list-home">
  <ul class="slides">';
 while ( $r->have_posts()) { 
	$r->the_post();
	global $product, $yith_wcwl;
	/*--------------------------------------------------------------------------------------------------
		New BADGE
	--------------------------------------------------------------------------------------------------*/
		global $data;
		$new_label = '';
		if (true) {
		
			$now = time();
			$diff = (get_the_time('U') > $now) ? get_the_time('U') - $now : $now - get_the_time('U');
			$val = floor($diff/86400);
			$days = floor(get_the_time('U')/(86400));
			
			if ( Helix::Param('woo_new_badge_days') >= $val ) {
				$new_label = '<div class="nova-product-label nova-new-label">'.__('New').'!</div>';
			}
	
		} 
/*--------------------------------------------------------------------------------------------------
	SALE BADGE
--------------------------------------------------------------------------------------------------*/
	$on_sale = '';
	if ($product->is_on_sale()) : 

		$on_sale = '<div class="nova-product-label nova-sale-label">'.__('Sale').'!</div>'; 

	endif;


	if (Helix::Param('woo_catalog_mode')) {
		$zlink  = '';
	} else {
		$link 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
		$label 	= apply_filters( 'add_to_cart_text', __('<i class="icon-bag"></i>', 'woocommerce') );
		$zlink  = '<a href="'. $link .'" rel="nofollow" data-product_id="'.$product->id.'" class="add_to_cart_button product_type_overhead">'. $label.'</a>';
	}
	
	
    echo '<li>
    	<div class="product-images">
    			'.$new_label.'
    	    	'.$on_sale.'
    <div class="quickview-box">
				<a class="hs-rsp-popup hiddendiv quickview_small" href="#product-'.$r->post->ID.'" data-id="'.$r->post->ID.'" data-popupwidth="760" data-popupheight="460">Quick View</a> 
	</div>
			<div class="descriptions-hidden">		
				<div class="quick-act">            
					'.$zlink;
					do_action('nova_compare_link');
					do_action('nova_wishlist_link');
			echo '</div>
			</div>
     <a href="' . get_permalink() . '"> ';
     if(Helix::Param('woo_img_hover')){
      echo '<div class="front">
     ' . ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) ) . '
     </div>';
     					$attachment_ids = $product->get_gallery_attachment_ids();
     					$i=1;
 						foreach ( $attachment_ids as $simage ) {
							if ($i==1) {
								$image       = wp_get_attachment_image( $simage, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ) );
								echo '<div class="product-img-additional back">'.$image.'</div>';
							}
							$i++;
							
						}  
	}else {
		echo ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) );
	}
     
   echo  '</a>
      </div>
      <h3 class="nova-product-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>
'.$product->get_price_html();
?>

			<div id="product-<?php echo $product->id; ?>" style="display:none">
				<div class="images">
				<?php echo ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) ) ; ?>
				</div>
				<div class="summary entry-summary">
					<?php
						/**
						 * woocommerce_single_product_summary hook
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div>

<?php
    echo '</li>';
  }
      echo '</ul>      
</div>
';

		endif;

        wp_reset_postdata();
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
		global $woocommerce;

		$cache = wp_cache_get('widget_best_sellers', 'widget');

		if ( !is_array($cache) ) $cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Best Sellers', 'woocommerce' ) : $instance['title'], $instance, $this->id_base);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

    	$query_args = array(
    		'posts_per_page' => $number,
    		'post_status' 	 => 'publish',
    		'post_type' 	 => 'product',
    		'meta_key' 		 => 'total_sales',
    		'orderby' 		 => 'meta_value_num',
    		'no_found_rows'  => 1,
    	);

    	$query_args['meta_query'] = array();

    	if ( isset( $instance['hide_free'] ) && 1 == $instance['hide_free'] ) {
    		$query_args['meta_query'][] = array(
			    'key'     => '_price',
			    'value'   => 0,
			    'compare' => '>',
			    'type'    => 'DECIMAL',
			);
    	}

	    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
	    $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();

		$r = new WP_Query($query_args);

		if ( $r->have_posts() ) {

			echo $before_widget;
echo '
<div class="products-tabs">
<div class="tabs-title">
<ul class="product-list-tabs" data-tabs="tabs">
    <li class="active"><a data-toggle="tab" href="#tab1">Feature Products</a></li>
    <li>\</li>
    <li class="last"><a data-toggle="tab" href="#tab2">Sale Products</a></li>
</ul>
</div>
<div class="tab-content">
    <div class="tab-pane active" id="tab1">
           
    ';
				echo '
	<script type="text/javascript">
				  
    jQuery(window).load(function(){
      jQuery(\'.best-seller\').flexslider({
        animation: "slide",
        animationLoop: false,
        itemWidth: 180,
        itemMargin: 18,
        controlNav: false,
        prevText: "<i class=\"icon-left-open-big\"></i>",
        nextText: "<i class=\"icon-right-open-big\"></i>" 
        
      });
    });
  </script>
<div class="best-seller flexslider products-list-home">
  <ul class="slides">';
 while ( $r->have_posts()) { 
	$r->the_post();
	global $product, $yith_wcwl;
	/*--------------------------------------------------------------------------------------------------
		New BADGE
	--------------------------------------------------------------------------------------------------*/
		global $data;
		$new_label = '';
		if (true) {
		
			$now = time();
			$diff = (get_the_time('U') > $now) ? get_the_time('U') - $now : $now - get_the_time('U');
			$val = floor($diff/86400);
			$days = floor(get_the_time('U')/(86400));
			
			if ( Helix::Param('woo_new_badge_days') >= $val ) {
				$new_label = '<div class="nova-product-label nova-new-label">'.__('New').'!</div>';
			}
	
		} 
/*--------------------------------------------------------------------------------------------------
	SALE BADGE
--------------------------------------------------------------------------------------------------*/
	$on_sale = '';
	if ($product->is_on_sale()) : 

		$on_sale = '<div class="nova-product-label nova-sale-label">'.__('Sale').'!</div>'; 

	endif;

	if (Helix::Param('woo_catalog_mode')) {
		$zlink  = '';
	} else {
		$link 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
		$label 	= apply_filters( 'add_to_cart_text', __('<i class="icon-bag"></i>', 'woocommerce') );
		$zlink = '<a href="'. $link .'" rel="nofollow" data-product_id="'.$product->id.'" class="add_to_cart_button product_type_overhead">'. $label.'</a>';
	}
		
    echo '<li>
    	<div class="product-images">
    			'.$new_label.'
    	    	'.$on_sale.'
    <div class="quickview-box">
				<a class="hs-rsp-popup hiddendiv quickview_small" href="#product-'.$r->post->ID.'" data-id="'.$r->post->ID.'" data-popupwidth="760" data-popupheight="460">Quick View</a> 
	</div>
			<div class="descriptions-hidden">		
				<div class="quick-act">            
					'.$zlink;
					do_action('nova_compare_link');
					do_action('nova_wishlist_link');
			echo '</div>
			</div>
     <a href="' . get_permalink() . '"> ';
     if(Helix::Param('woo_img_hover')){
      echo '<div class="front">
     ' . ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) ) . '
     </div>';
     					$attachment_ids = $product->get_gallery_attachment_ids();
     					$i=1;
 						foreach ( $attachment_ids as $simage ) {
							if ($i==1) {
								$image       = wp_get_attachment_image( $simage, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ) );
								echo '<div class="product-img-additional back">'.$image.'</div>';
							}
							$i++;
							
						}  
	}else {
		echo ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) );
	}
     
   echo  '</a>

      </div>
      <h3 class="nova-product-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>
'.$product->get_price_html();
?>
			<div id="product-<?php echo $product->id; ?>" style="display:none">
				<div class="images">
				<?php echo ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) ) ; ?>
				</div>
				<div class="summary entry-summary">
					<?php
						/**
						 * woocommerce_single_product_summary hook
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 */
						do_action( 'woocommerce_single_product_summary' );
					?>
				</div>
			</div>

<?php
    echo '</li>';
  }
      echo '</ul>      
</div>
';
echo '
 </div>
    <div class="tab-pane" id="tab2">';
    $this->_featured_products($instance['number']);
    echo '</div>
</div>
</div>';

			echo $after_widget;
		}

		$content = ob_get_clean();

		if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

		echo $content;

		wp_cache_set('widget_best_sellers', $cache, 'widget');
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
		$instance['hide_free'] = 0;

		if ( isset( $new_instance['hide_free'] ) ) {
			$instance['hide_free'] = 1;
		}

		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_best_sellers']) ) delete_option('widget_best_sellers');

		return $instance;
	}


	/**
	 * flush_widget_cache function.
	 *
	 * @access public
	 * @return void
	 */
	function flush_widget_cache() {
		wp_cache_delete( 'widget_best_sellers', 'widget' );
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
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] ) $number = 10;
		$hide_free_checked = ( isset( $instance['hide_free'] ) && 1 == $instance['hide_free'] ) ? ' checked="checked"' : '';

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'woocommerce' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of products to show:', 'woocommerce' ); ?></label>
		<input id="<?php echo esc_attr( $this->get_field_id('number') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<p><input id="<?php echo esc_attr( $this->get_field_id('hide_free') ); ?>" name="<?php echo esc_attr( $this->get_field_name('hide_free') ); ?>" type="checkbox"<?php echo $hide_free_checked; ?> />
		<label for="<?php echo $this->get_field_id('hide_free'); ?>"><?php _e( 'Hide free products', 'woocommerce' ); ?></label></p>

		<?php
	}
}