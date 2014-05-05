<?php
/**
 * Featured Products Shortcode
 *
 * Gets and displays featured products in an unordered list
 * 
 * [nova_products type="feature"]
 * 
 * [nova_products type="sale"]
 *
 */

if(!function_exists('nova_products_sc')) {
	function nova_products_sc( $atts, $content="" ){
		extract(shortcode_atts(array(
					'feature_title' => 'Feature Products',
					'sale_title' => 'Sale Products',
					'feature_id' => 'best-seller',
					'sale_id' => 'featured-products',	
				   'type' => 'feature',
				   'class' => '', // flat_left
				   'number' => '10',
				   'slide'	=> 'slide',
				   'image'	=> '',
				   'hide_free' => '1'
		), $atts));
		
		global $comments, $comment, $woocommerce;
		
		ob_start();
		
		if (!$number)
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;
		
		// Featured Products
		if($type=='feature') {
	
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
				if ($slide=='none'){
					echo '<div class="feature-box row-fluid"><div class="feature-left span3">';
					echo '<div class="feature-block"><h2>'.$feature_title.'</h2><p>Mango Women’s Sheer</p></div><img src="'.$image.'" width="192" height="252" border="0" />';
					echo '</div>';
					echo '<div class="feature-right span9"><div class="row row-fluid">';
					
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
					
						if ( Helix::Param('woo_catalog_mode') ) {
							$zlink  = '';
						} else {
							$link 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
							$label 	= apply_filters( 'add_to_cart_text', __('<i class="icon-bag"></i>', 'woocommerce') );
							$zlink = '<a href="'. $link .'" rel="nofollow" data-product_id="'.$product->id.'" class="add_to_cart_button product_type_overhead">'. $label.'</a>';
						}						
							
					    echo '<div class="span3 product">
					    		<div class="product-list-item ">
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
					    echo '</div></div>';
					}
					
					echo '</div></div></div>';
				}
				else {
					echo '<div class="recent_works '.$class.'">
						<div class="recent-works-title">
						<h3>'.$feature_title.'</h3>
						</div>
						<div class="'.$feature_id.' flexslider products-list-home">
						<script type="text/javascript">
							jQuery(window).load(function(){
								jQuery(\'.'.$feature_id.'\').flexslider({
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
					
						if ( Helix::Param('woo_catalog_mode') ) {
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
					echo '</ul></div></div>';
				}
			}

		}
		
		// Sale Products
		if($type=='sale') {
			$query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );
			$query_args['meta_query'] = array();

			$query_args['meta_query'][] = array(
				'key' => '_featured',
				'value' => 'yes'
			);
		    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
		    $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
	
			$r = new WP_Query($query_args);
			
			if ($r->have_posts()) {
				if ($slide=='none'){
					echo '<div class="feature-box row-fluid"><div class="feature-left span3">';
					echo '<div class="feature-block"><h2>'.$sale_title.'</h2><p>Mango Women’s Sheer</p></div><img src="'.$image.'" width="192" height="252" border="0" />';
					echo '</div>';
					echo '<div class="feature-right span9"><div class="row row-fluid">';
					
					
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
							
							if ( Helix::Param('woo_catalog_mode') ) {
								$zlink  = '';
							} else {
								$link 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
								$label 	= apply_filters( 'add_to_cart_text', __('<i class="icon-bag"></i>', 'woocommerce') );
								$zlink = '<a href="'. $link .'" rel="nofollow" data-product_id="'.$product->id.'" class="add_to_cart_button product_type_overhead">'. $label.'</a>';
							}	
			
						    echo '<div class="span3 product">
					    		<div class="product-list-item ">
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
					    echo '</div></div>';
					}
					
					
					
					echo '</div></div></div>';
				}else{
			 
				echo '<div class="recent_works '.$class.'">
					<div class="recent-works-title">
					<h3>'.$sale_title.'</h3>
					</div>
					<div class="'.$sale_id.' flexslider products-list-home">
						<script type="text/javascript">
					    jQuery(window).load(function(){
					      jQuery(\'.'.$sale_id.'\').flexslider({
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
							
							if ( Helix::Param('woo_catalog_mode') ) {
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
					echo '</ul></div></div>';
				}
			}
			
		}
		return ob_get_clean();
		
	}
	add_shortcode( 'nova_products', 'nova_products_sc' );
}

if(!function_exists('nova_tab_products_sc')) {
	function nova_tab_products_sc( $atts, $content="" ){
		extract(shortcode_atts(array(
					'feature_title' => 'Feature Products',
					'sale_title' => 'Sale Products',
					'feature_id' => 'best-seller',
					'sale_id' => 'featured-products',	
				   'type' => 'feature',
				   'number' => '10',
				   'slide'	=> 'slide',
				   'image'	=> '',
				   'hide_free' => '1'
		), $atts));
		
		global $woocommerce;
		
		ob_start();	
		
		if (!$number)
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;	

echo '
<div class="products-tabs">
	<div class="tabs-title">
		<ul class="product-list-tabs" data-tabs="tabs">
		    <li class="active"><a data-toggle="tab" href="#tab1">'.$feature_title.'</a></li>
		    <li>\</li>
		    <li class="last"><a data-toggle="tab" href="#tab2">'.$sale_title.'</a></li>
		</ul>
	</div>
	<div class="tab-content">
	    <div class="tab-pane active" id="tab1">';

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
		if ($r->have_posts()) {
			echo '<div class="'.$feature_id.' flexslider products-list-home">
				<script type="text/javascript">
					jQuery(window).load(function(){
						jQuery(\'.'.$feature_id.'\').flexslider({
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
				
					if ( Helix::Param('woo_catalog_mode') ) {
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
			echo '</ul></div>';			
					
		}		
		
echo 	'</div>
	    <div class="tab-pane" id="tab2">';

			$query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );
			$query_args['meta_query'] = array();

			$query_args['meta_query'][] = array(
				'key' => '_featured',
				'value' => 'yes'
			);
		    $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
		    $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
	
			$r = new WP_Query($query_args);
			if ($r->have_posts()) {

			echo '<div class="'.$sale_id.' flexslider products-list-home">
					<script type="text/javascript">
				    jQuery(window).load(function(){
				      jQuery(\'.'.$sale_id.'\').flexslider({
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
						
						if ( Helix::Param('woo_catalog_mode') ) {
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
				echo '</ul></div>';
				
			}
	
echo	'</div>
	</div>
</div>';
		return ob_get_clean();
	}
	
	add_shortcode( 'nova_tab_products', 'nova_tab_products_sc' );	
	
}

if(!function_exists('nova_block_products_sc')) {
	function nova_block_products_sc( $atts, $content="" ){

		extract(shortcode_atts(array(
					'title' => 'Best Seller',
					'block_id' => 'best-sellers', // 'top-rateds', 'recent_reviews'
				   'type' => '1', //1: Best Seller - 2: Top Rated - 3: Recent Reviews
				   'number' => '10',
				   'hide_free' => '1'
		), $atts));
		
		global $woocommerce;
		
		ob_start();
		
		if (!$number)
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		echo '<div class="best_sellers sp-widget woocommerce"><h3>'.$title.'<i class="icon-right-open-big"></i></h3>';

		if ($type==1) { // Best Seller

		   	$query_args = array(
		    		'posts_per_page' => $number,
		    		'post_status' 	 => 'publish',
		    		'post_type' 	 => 'product',
		    		'meta_key' 		 => 'total_sales',
		    		'orderby' 		 => 'meta_value_num',
		    		'no_found_rows'  => 1,
	    	);
	
	    	$query_args['meta_query'] = $woocommerce->query->get_meta_query();
	
	    	if ( isset( $instance['hide_free'] ) && 1 == $instance['hide_free'] ) {
	    		$query_args['meta_query'][] = array(
				    'key'     => '_price',
				    'value'   => 0,
				    'compare' => '>',
				    'type'    => 'DECIMAL',
				);
	    	}
	
			$r = new WP_Query($query_args);
			
			if ( $r->have_posts() ) {
				
			echo '
				<script type="text/javascript">
					  
			    jQuery(window).load(function(){
			      var width_doc = jQuery(document).width();
				  if(width_doc >960){
				      jQuery(\'.'.$block_id.'\').flexslider({
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
				      jQuery(\'.'.$block_id.'\').flexslider({
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
				<div class="'.$block_id.' flexslider products-list-home">
				<ul class="slides">';

				while ( $r->have_posts()) {
					$r->the_post();
					global $product;
	
					echo '<li>
						<a href="' . get_permalink() . '">
							' . ( has_post_thumbnail() ? get_the_post_thumbnail( $r->post->ID, 'shop_catalog' ) : woocommerce_placeholder_img( 'shop_catalog' ) ) . ' ' . get_the_title() . '
						</a> ' . $product->get_price_html() . '
					</li>';
				}
				
			echo '</ul></div>';	
			}
			
		} elseif ($type==2) { // Top Rated
			add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
	
			$query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );
	
			$query_args['meta_query'] = $woocommerce->query->get_meta_query();
	
			$top_rated_posts = new WP_Query( $query_args );
			
			if ($top_rated_posts->have_posts()) {
			?>

			<script type="text/javascript">
						  
		    jQuery(window).load(function(){
		    	var width_doc = jQuery(document).width();
		    	if(width_doc >960){
			      jQuery('.<?php echo $block_id; ?>').flexslider({
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
			      jQuery('.<?php echo $block_id; ?>').flexslider({
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

			<div class="<?php echo $block_id; ?> flexslider products-list-home">
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
			}

			wp_reset_query();
			remove_filter( 'posts_clauses', array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
		} elseif($type==3) { // Recent Reviews
			
			$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product' ) );
			
			if ( $comments ) {
				echo '
				<script type="text/javascript">
							  
			    jQuery(window).load(function(){
			      var width_doc = jQuery(document).width();
				  if(width_doc >960){
				      jQuery(\'.'.$block_id.'\').flexslider({
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
				      jQuery(\'.'.$block_id.'\').flexslider({
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
				<div class="'.$block_id.' flexslider products-list-home">
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
			}			
		}			
		
		echo '</div>';
		
		return ob_get_clean();		

	}
	add_shortcode( 'nova_block_products', 'nova_block_products_sc' );
}

?>