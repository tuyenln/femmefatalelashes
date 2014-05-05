<?php
/**
 * Widget Post: Nova Widget Recent Blog
 * NovaWidgetBlog Class
 */
class NovaWidgetRecentBlog extends WP_Widget {
    
    function NovaWidgetRecentBlog() {
        parent::WP_Widget(false, $name = 'Nova Widget - From The Blog', array('description' =>__( 'Show posts from a category','nova-widget-recent-blog')));
    }
	
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
        $ecat = apply_filters('widget_title', $instance['ecat']);        
        $cantidad = empty($instance['cantidad']) ? '5' : apply_filters('widget_title', $instance['cantidad']);
        $oby = apply_filters('widget_title', $instance['oby']);
        $omode = empty($instance['omode']) ? 'DESC' : apply_filters('widget_title', $instance['omode']);
        $tamo = apply_filters('widget_title', $instance['tamo']);
        $st = apply_filters('widget_title', $instance['st']);
        $se = apply_filters('widget_title', $instance['se']);
        $sml = apply_filters('widget_title', $instance['sml']);

        $cantidad2 = empty($instance['cantidad2']) ? '0' : apply_filters('widget_title', $instance['cantidad2']);
        $tamo2 = apply_filters('widget_title', $instance['tamo2']);
        $st2 = apply_filters('widget_title', $instance['st2']);
        $se2 = apply_filters('widget_title', $instance['se2']);
        
        $sf = apply_filters('widget_title', $instance['sf']);

        ?>

        <?php
            if (!$sf) $cantidad2 = 0;
            $cuantos = $cantidad + $cantidad2;
            $query = new WP_Query("posts_per_page=$cuantos&cat=$ecat&orderby=$oby&order=$omode");
            $cat_nombre=get_cat_name($ecat);
            $c = 1;
            $c2 = 1;
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        //echo $before_title . $cat_nombre . $after_title;
                        echo '<div class="recent-blog-title">' . $before_title . $title . $after_title . '</div>'; ?>
                        <ul class="recent-blog-list">
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
								<li <?php if ($c == $cantidad) echo 'class="last"'; ?>>
									<?php if($c <= $cantidad){ $c++; /* Formato para vistas primarias*/ ?>

                                            <?php if ( $st && has_post_thumbnail() ) : ?>
                                                <span class="alignleft">
                                                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail($tamo); ?></a>
                                                </span>
                                            <?php endif ?>

                                            <h4 class="nova-widget-recent-blog-tittle nova-widget-recent-blog-tittle-main">   <a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a></h4>
											<span class="post-date"><em class="icon-window"></em><?php echo " On ". get_the_time("d M, Y"); ?> <em class="icon-user"></em><?php echo " by " . get_the_author(); ?></span>

                                            <?php if($se) the_excerpt(); ?>
											<a class="nova-widget-recent-blog-sml" href="<?php echo the_permalink(); ?>"><?php _e("READ MORE",'nova-widget-recent-blog'); ?></a>

                                            <?php } else { /* Formato para v. secudarias */ ?>
                                                 <?php if ( $st2 && has_post_thumbnail() ) : ?>
                                                    <span class="alignleft">
                                                        <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail($tamo2); ?></a>
                                                    </span>
                                                <?php endif ?>

                                                <h4 class="nova-widget-recent-blog-tittle nova-widget-recent-blog-tittle-secondary">   <a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a></h4>

                                                <?php if($se2) the_excerpt(); ?>    
												
									<?php } ?>
								</li>
                            <?php endwhile; ?>
                    </ul>
					

                        <?php if($sml): ?>
                            <a class="nova-widget-recent-blog-sml" href="<?php echo get_category_link($ecat); ?>"><?php _e("See more ",'nova-widget-recent-blog'); echo $cat_nombre ?></a>
                        <?php endif; ?>
					<div class="clear"></div>
              <?php echo $after_widget; ?>
        <?php
    }

    
    function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
        $instance['ecat'] = strip_tags($new_instance['ecat']);
        $instance['cantidad'] = strip_tags($new_instance['cantidad']);        
        $instance['oby'] = strip_tags($new_instance['oby']);
        $instance['omode'] = strip_tags($new_instance['omode']);        
        $instance['tamo'] = strip_tags($new_instance['tamo']);
        $instance['st'] = strip_tags($new_instance['st']);
        $instance['se'] = strip_tags($new_instance['se']);
        $instance['sml'] = strip_tags($new_instance['sml']);

        $instance['cantidad2'] = strip_tags($new_instance['cantidad2']);
        $instance['tamo2'] = strip_tags($new_instance['tamo2']);
        $instance['st2'] = strip_tags($new_instance['st2']);
        $instance['se2'] = strip_tags($new_instance['se2']);

        $instance['sf'] = strip_tags($new_instance['sf']);

        return $instance;
    }

    
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : "";
        $ecat = isset($instance['ecat']) ?  esc_attr($instance['ecat']) : "";
        $cantidad = isset($instance['cantidad']) ? esc_attr($instance['cantidad']) : '5';
        $oby = isset($instance['oby']) ? esc_attr($instance['oby']) : "";
        $omode = isset($instance['omode']) ? esc_attr($instance['omode']) : "DESC";
        $tamo = isset($instance['tamo']) ? esc_attr($instance['tamo']) : "";
        $st = isset($instance['st']) ? esc_attr($instance['st']) : "";
        $se = isset($instance['se']) ? esc_attr($instance['se']) : "";
        $sml = isset($instance['sml']) ? esc_attr($instance['sml']) : "";

        $cantidad2 = isset($instance['cantidad2']) ? esc_attr($instance['cantidad2']) : '0';
        $tamo2 = isset($instance['tamo2']) ? esc_attr($instance['tamo2']) : "";
        $st2 = isset($instance['st2']) ? esc_attr($instance['st2']) : "";
        $se2 = isset($instance['se2']) ? esc_attr($instance['se2']) : "";
        $sf = isset($instance['sf']) ? esc_attr($instance['sf']) : "";

        $mm1 =  "pid-" . $this->get_field_id('st');
        $mm2 =  "pid-" . $this->get_field_id('st2');
        $msf =  "pid-" . $this->get_field_id('sf');

        ?>

            <script type="text/javascript">
             jQuery(document).ready(function(){
                 var js_mm1 = "<?php echo $mm1 ?>".substring(4);
                 var js_mm2 = "<?php echo $mm2 ?>".substring(4);
                 var js_msf = "<?php echo $msf ?>".substring(4);

                 if( !jQuery("#"+js_mm1).is(':checked') )
                    jQuery("#pid-"+js_mm1).hide();

                 if( !jQuery("#"+js_mm2).is(':checked') )
                    jQuery("#pid-"+js_mm2).hide();

                 if( !jQuery("#"+js_msf).is(':checked') )
                    jQuery("#pid-"+js_msf).hide();
              });
            </script>

            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','nova-widget-recent-blog'); ?> </label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>            

            <p>
                <label for="<?php echo $this->get_field_id('ecat'); ?>"><?php _e('Category:','nova-widget-recent-blog'); ?> </label>
                <?php wp_dropdown_categories(array(
                        'class' =>      'widefat',
                        'id' =>         $this->get_field_id('ecat'),
                        'name' =>       $this->get_field_name('ecat'),
                        'selected' =>   $ecat,
                        'hide_empty' => 0,
                        'hierarchical' => 1
                )); ?>
            </p>            

            <p>
                <label for="<?php echo $this->get_field_id('oby'); ?>"><?php _e('Order by:','nova-widget-recent-blog'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id('oby'); ?>"  name="<?php echo $this->get_field_name('oby'); ?>" >
                	<option value="date" <?php if ($oby=="date") echo "selected='selected'" ?>><?php _e('Date','nova-widget-recent-blog') ?></option>
                	<option value="modified" <?php if ($oby=="modified") echo "selected='selected'" ?>><?php _e('Modified','nova-widget-recent-blog') ?></option>
                    <option value="rand" <?php if ($oby=="rand") echo "selected='selected'" ?> ><?php _e('Random','nova-widget-recent-blog') ?></option>
                    <option value="title" <?php if ($oby=="title") echo "selected='selected'" ?> ><?php _e('Title','nova-widget-recent-blog') ?></option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('omode'); ?>"><?php _e('Order mode:','nova-widget-recent-blog'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id('omode'); ?>"  name="<?php echo $this->get_field_name('omode'); ?>" >
                    <option value="DESC" <?php if ($omode=="DESC") echo "selected='selected'" ?>><?php _e('Descending order','nova-widget-recent-blog') ?></option>                    
                    <option value="ASC" <?php if ($omode=="ASC") echo "selected='selected'" ?>><?php _e('Ascending order','nova-widget-recent-blog') ?></option>                    
                </select>
            </p>


            <?php /* Datos entrada principal ------------------------------------------------------------- */ ?>
            
            <div style="height: 1px; overflow: hidden; width: 100%; border-bottom: 1px solid #DFDFDF;">&nbsp;</div>
            <h4><?php _e('Main post format','nova-widget-recent-blog'); ?></h4>

            <p>
                <label for="<?php echo $this->get_field_id('cantidad'); ?>"><?php _e('How many post?:','nova-widget-recent-blog'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('cantidad'); ?>" name="<?php echo $this->get_field_name('cantidad'); ?>" type="text" value="<?php echo $cantidad; ?>" />
            </p>

           <p>
                <input class="checkbox" id="<?php echo $this->get_field_id('se'); ?>" name="<?php echo $this->get_field_name('se'); ?>" type="checkbox" value="1" <?php if($se) echo 'checked' ?> />
                <label for="<?php echo $this->get_field_id('se'); ?>"><?php _e('Show excerpt ','nova-widget-recent-blog'); ?> </label>
                <br />
                
                <input onclick="ev_toogle(this,'<?php echo $mm1 ?>'); " class="checkbox" id="<?php echo $this->get_field_id('st'); ?>" name="<?php echo $this->get_field_name('st'); ?>" type="checkbox" value="1" <?php if($st) echo 'checked' ?> />
                <label for="<?php echo $this->get_field_id('st'); ?>"><?php _e('Show thumbnail ','nova-widget-recent-blog'); ?> </label>
                <br />
            </p>

            <p id="<?php echo $mm1 ?>">
                <label for="<?php echo $this->get_field_id('tamo'); ?>"><?php _e('Thumbnail size:','nova-widget-recent-blog'); ?></label>
                <select class="widefat" id="<?php echo $this->get_field_id('tamo'); ?>"  name="<?php echo $this->get_field_name('tamo'); ?>" >
                    <option value="thumbnail" <?php if ($tamo=="thumbnail") echo "selected='selected'" ?> ><?php _e('Thumbnail','nova-widget-recent-blog') ?></option>
                    <option value="medium" <?php if ($tamo=="medium") echo "selected='selected'" ?>><?php _e('Medium','nova-widget-recent-blog') ?></option>
                    <option value="large" <?php if ($tamo=="large") echo "selected='selected'" ?>><?php _e('Large','nova-widget-recent-blog') ?></option>
                </select>
            </p>

            <?php /* Datos entrada secundaria ------------------------------------------------------------- */ ?>

            <div id="<?php echo $msf ?>">

                <div style="height: 1px; overflow: hidden; width: 100%; border-bottom: 1px solid #DFDFDF;">&nbsp;</div>
                <h4><?php _e('Secondary post format','nova-widget-recent-blog'); ?></h4>

                <p>
                    <label for="<?php echo $this->get_field_id('cantidad2'); ?>"><?php _e('How many post?:','nova-widget-recent-blog'); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id('cantidad2'); ?>" name="<?php echo $this->get_field_name('cantidad2'); ?>" type="text" value="<?php echo $cantidad2; ?>" />
                </p>

               <p>
                    <input class="checkbox" id="<?php echo $this->get_field_id('se2'); ?>" name="<?php echo $this->get_field_name('se2'); ?>" type="checkbox" value="1" <?php if($se2) echo 'checked' ?> />
                    <label for="<?php echo $this->get_field_id('se2'); ?>"><?php _e('Show excerpt ','nova-widget-recent-blog'); ?> </label>
                    <br />

                    <input onclick="ev_toogle(this,'<?php echo $mm2 ?>'); " class="checkbox" id="<?php echo $this->get_field_id('st2'); ?>" name="<?php echo $this->get_field_name('st2'); ?>" type="checkbox" value="1" <?php if($st2) echo 'checked' ?> />
                    <label for="<?php echo $this->get_field_id('st2'); ?>"><?php _e('Show thumbnail ','nova-widget-recent-blog'); ?> </label>
                    <br />
                </p>

                <p id="<?php echo $mm2 ?>">
                    <label for="<?php echo $this->get_field_id('tamo2'); ?>"><?php _e('Thumbnail size:','nova-widget-recent-blog'); ?></label>
                    <select class="widefat" id="<?php echo $this->get_field_id('tamo2'); ?>"  name="<?php echo $this->get_field_name('tamo2'); ?>" >
                        <option value="thumbnail" <?php if ($tamo2=="thumbnail") echo "selected='selected'" ?> ><?php _e('Thumbnail','nova-widget-recent-blog') ?></option>
                        <option value="medium" <?php if ($tamo2=="medium") echo "selected='selected'" ?>><?php _e('Medium','nova-widget-recent-blog') ?></option>
                        <option value="large" <?php if ($tamo2=="large") echo "selected='selected'" ?>><?php _e('Large','nova-widget-recent-blog') ?></option>
                    </select>
                </p>
                
            </div>

            <?php /* Ver mas -> */ ?>
            
            <div style="height: 1px; overflow: hidden; width: 100%; border-bottom: 1px solid #DFDFDF; margin-bottom:10px;">&nbsp;</div>
            <p>

                <input onclick="ev_toogle(this,'<?php echo $msf ?>'); " class="checkbox" id="<?php echo $this->get_field_id('sf'); ?>" name="<?php echo $this->get_field_name('sf'); ?>" type="checkbox" value="1" <?php if($sf) echo 'checked' ?> />
                <label for="<?php echo $this->get_field_id('sf'); ?>"><?php _e('Enable secondary format','nova-widget-recent-blog'); ?> </label>
                <br />
                
                <input class="checkbox" id="<?php echo $this->get_field_id('sml'); ?>" name="<?php echo $this->get_field_name('sml'); ?>" type="checkbox" value="1" <?php if($sml) echo 'checked' ?> />
                <label for="<?php echo $this->get_field_id('sml'); ?>"><?php _e('Show *See More* link ','nova-widget-recent-blog'); ?> </label>                
            </p>
        <?php
    }

} // class NovaWidgetRecentBlog
/*
function ev_w_js() {
        echo '<script type="text/javascript" src="' .plugins_url('ev_w_js.js', __FILE__).'"></script>';
}

add_action('widgets_init', create_function('', 'return register_widget("NovaWidgetRecentBlog");'));
add_action('admin_head', 'ev_w_js');
$plugin_dir = basename(dirname(__FILE__));
load_plugin_textdomain( 'nova-widget-recent-blog', null, $plugin_dir . '/languages/' );
*/
?>
