<?php
    /**
    * @package Helix Framework
    * @author JoomShaper http://www.joomshaper.com
    * @copyright Copyright (c) 2010 - 2013 JoomShaper
    * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
    */

    define('_THEME', get_template()); //Define _THEME
    define('DS', '/');
require_once ('helix/helix.php');
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once ('plugins/class-tgm-plugin-activation.php');
 
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name, slug and required.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
 
        // This is an example of how to include a plugin pre-packaged with a theme
        array(
            'name'                  => 'Revolution Slider', // The plugin name
            'slug'                  => 'revslider', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/revslider.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '3.0.7', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
 
        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'                  => 'Flickr Badges Widget', // The plugin name
            'slug'                  => 'flickr-badges-widget', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/flickr-badges-widget.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.2.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),

         // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'                  => 'Woocommerce Grid List Toggle', // The plugin name
            'slug'                  => 'woocommerce-grid-list-toggle', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/woocommerce-grid-list-toggle.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '0.3.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),        
         // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'                  => 'Yith Woocommerce Wishlist', // The plugin name
            'slug'                  => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/yith-woocommerce-wishlist.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),  
         // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'                  => 'Yith Woocommerce Compare', // The plugin name
            'slug'                  => 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/yith-woocommerce-compare.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.0.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),        
         // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'                  => 'Sidebar Login', // The plugin name
            'slug'                  => 'sidebar-login', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/sidebar-login.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.6.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),    
        array(
            'name'                  => 'Portfolio', // The plugin name
            'slug'                  => 'portfolio', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/portfolio.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.16', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),  
        array(
            'name'                  => 'Woocommerce', // The plugin name
            'slug'                  => 'woocommerce', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/woocommerce.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.0.13', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),   
        array(
            'name'                  => 'Widget Settings Importer/Exporter', // The plugin name
            'slug'                  => 'widget-settings-importexport', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/widget-settings-importexport.1.2.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ), 
        array(
            'name'                  => 'Sub Categories Widget', // The plugin name
            'slug'                  => 'sub-categories-widget', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/sub-categories-widget.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ), 
        array(
            'name'                  => 'WP Polls', // The plugin name
            'slug'                  => 'wp-polls', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/wp-polls.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.63', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ), 
        array(
            'name'                  => 'Zwoom Woocommerce Product Image Zoom', // The plugin name
            'slug'                  => 'zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/zwoom-woocommerce-product-image-zoom-extension-by-wisdmlabs.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),   
        array(
            'name'                  => 'Peally Simple Popup', // The plugin name
            'slug'                  => 'really-simple-popup', // The plugin slug (typically the folder name)
            'source'                => get_stylesheet_directory() . '/plugins/really-simple-popup.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '1.0.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ), 
    );
 
    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'bearstore';
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => $theme_text_domain,           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
        'parent_url_slug'   => 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', $theme_text_domain ),
            'menu_title'                                => __( 'Install Plugins', $theme_text_domain ),
            'installing'                                => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            'return'                                    => __( 'Return to Required Plugins Installer', $theme_text_domain ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', $theme_text_domain ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
        )
    );
 
    tgmpa( $plugins, $config );
 
}
    $require_helix_text = '"'.wp_get_theme().'" required Helix plugin. <a target="_blank" href="http://www.joomshaper.com/helix/wordpress">Please install and activate Helix plugin.</a>';

    function showMessage()
    {
        global $require_helix_text;
        echo '<div id="message" class="error">';
        echo "<p><strong>$require_helix_text</strong></p></div>";
    }

    if( !class_exists('Helix') ){
        if( is_admin() and $pagenow=='customize.php' ){
            wp_die( $require_helix_text );
        }
        elseif(!is_admin()){
            wp_die( $require_helix_text );
        } else {
            add_action('admin_notices', 'showMessage');
            return;
        }
    }

    Helix::getInstance();
    $_preset = Helix::preset(); 
    $_direction = Helix::direction(); 
    if(!is_admin()) {
        Helix::setLessVariables(array(
                'preset'=> $_preset,
                'logo_image'=> '\''.Helix::Param('logo_image').'\'',
                'bg_color'=> Helix::PresetParam('_bg'),
                'header_color'=> Helix::PresetParam('_header'),
                'body_font'=> Helix::Param('body_font') ? '"'.Helix::Param('body_font').'"' : '"Helvetica Neue",Helvetica',
                'header_font'=> Helix::Param('header_font') ? '"'.Helix::Param('header_font').'"' : '"Helvetica Neue",Helvetica',
                'text_color'=> Helix::PresetParam('_text'),
                'link_color'=> Helix::PresetParam('_link'),
                'active_color'=> Helix::PresetParam('_active'),
                'icons_color'=> Helix::PresetParam('_icons'),
                'buttons_color'=> Helix::PresetParam('_buttons'),
                'newlabel_color'=> Helix::PresetParam('_newlabel'),
                'salelabel_color'=> Helix::PresetParam('_salelabel')
            ))
        ->addLess('master', 'theme')
        ->addLess( 'presets',  'presets/'. $_preset );
        Helix::addJS('menu.js');
    }
function my_theme_wrapper_start() {
  echo '<section id="main">';
}
 
function my_theme_wrapper_end() {
  echo '</section>';
}
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 584;
/*--------------------------------------------------------------------------------------------------
	ADD CUSTOM CSS
--------------------------------------------------------------------------------------------------*/
add_action( 'wp_head', 'font_css_file',3);
function font_css_file(){
	$theme_path = get_template_directory_uri();
	echo "<link rel=\"stylesheet\" href=\"".$theme_path."/css/bootstrap.min.css\">\n";
	echo "<link rel=\"stylesheet\" href=\"".$theme_path."/css/bootstrap-responsive.min.css\">\n";
	echo "<link rel=\"stylesheet\" href=\"".$theme_path."/style.css\">\n";
	echo "<link rel=\"stylesheet\" href=\"".$theme_path."/font/stylesheet.css\">\n";
	if(Helix::Param('body_font')) {
		echo "<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family=".Helix::Param('body_font')."\" type=\"text/css\" media=\"screen\" />\n";
	}
	if(Helix::Param('header_font') && Helix::Param('header_font') != Helix::Param('body_font')) {
		echo "<link rel=\"stylesheet\" href=\"http://fonts.googleapis.com/css?family=".Helix::Param('header_font')."\" type=\"text/css\" media=\"screen\" />\n";
	}
}
add_action( 'wp_head', 'flexslider_file');
function flexslider_file(){
	$theme_path = get_template_directory_uri();
	// echo "<link rel=\"stylesheet\" href=\"".$theme_path."/css/flexslider.css\">\n";
	// echo "<script type=\"text/javascript\" src=\"".$theme_path."/js/jquery.flexslider.js\"></script>\n";
	echo "<script type=\"text/javascript\" src=\"".$theme_path."/js/bearstore.custom.js\"></script>\n";
    echo "<link rel=\"stylesheet\" href=\"".$theme_path."/css/jquery.bxslider.css\">\n";
    echo "<script type=\"text/javascript\" src=\"".$theme_path."/js/jquery.bxslider.js\"></script>\n";
    echo "<script type=\"text/javascript\" src=\"".$theme_path."/js/jquery.bxslider.min.js\"></script>\n";
}

// add_action('wp_head', 'myflext_file');
// function myflext_file(){
//     echo "<link rel=\"stylesheet\" href=\"".$theme_path."/css/flexsliderme.css\">\n";
//     echo "<script type=\"text/javascript\" src=\"".$theme_path."/js/jquery.flexsliderme.js\"></script>\n";
//     echo "<script type=\"text/javascript\" src=\"".$theme_path."/js/jquery.flexslider-minme.js\"></script>\n";
// }
/*--------------------------------------------------------------------------------------------------
	ADD CUSTOM MENU
--------------------------------------------------------------------------------------------------*/
function register_nova_menus() {
  register_nav_menus(
    array(
      'top-header-menu' => __( 'Top Header Menu','bearstore'),
      'footer-menu' => __( 'Footer Menu','bearstore')
    )
  );
}
add_action( 'init', 'register_nova_menus' );

/*--------------------------------------------------------------------------------------------------
	WPML language switcher
--------------------------------------------------------------------------------------------------*/


add_action( 'nova_top_header', 'nova_wpml_language_switcher',3 );

if ( ! function_exists( 'nova_wpml_language_switcher' ) ) {	
	function nova_wpml_language_switcher () {
	
		if ( function_exists('icl_get_languages')) {
			global $data;
			if ( Helix::Param('show_flags') ) {
				echo '<ul class="topnav navLeft">';
				echo '<li class="languages drop"><a href="#"><span class="icon-globe icon-white"></span> '.__("LANGUAGES",'bearstore').'</a>';
				echo '<div class="pPanel">';
				echo '<ul class="inner">';
				
					$languages = icl_get_languages('skip_missing=0');
						if(1 < count($languages)){
							foreach($languages as $l){
								$active = '';
								$icon = '';
								
								if ( $l['active'] ){
									$active = 'active';
									$icon = '<span class="icon-ok"></span></a></li>';
								}
								echo '<li class="'.$active.'"><a href="'.$l['url'].'">'.$l['translated_name'].' '.$icon.'';
								
							}
						
					}
				echo '</ul>';
				echo '</div>';
				echo '</li>';
				echo '</ul>';
			}
		}else {
			if(Helix::Param('show_flags')) {
				echo '<div class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">'.__("LANGUAGES").'</a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	
				<li class="active"><a href="#">English <span class="icon-ok"></span></a></li>
				<li><a href="#">French</a></li>
				<li><a href="#">German</a></li>
			    </ul>
			    </div>';
			 }
		}

		
	}
}
/*--------------------------------------------------------------------------------------------------
	Pagination Functions
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_pagination' ) ) {	
	function zn_pagination($pages = '', $range = 2)
	{  
		$showitems = ($range * 2)+1;  

		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == '')
		{
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			
			if(!$pages)	{	$pages = 1;	}
			
		}   

		if(1 != $pages)
		{
		//__( 'Published in', 'bearstore' )
			echo "<div class='pagination'>";
			echo '<ul>';
			
			if(1 == $paged) {
				echo '<li class="pagination-start"><span class="pagenav">'.__( 'Start', 'bearstore' ).'</span></li>';
				echo '<li class="pagination-prev"><span class="pagenav">'.__( 'Prev', 'bearstore' ).'</span></li>';
			}
			else {
				echo '<li class="pagination-start"><a href="'.get_pagenum_link(1).'">'.__( 'Start', 'bearstore' ).'</a></li>';
				echo '<li class="pagination-prev"><a href="'.get_pagenum_link($paged-1).'">'.__( 'Prev', 'bearstore' ).'</a></li>';
			}

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					//echo ($paged == $i)? "<span class='current zn_default_color_active'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive zn_default_color' >".$i."</a>";
					echo ($paged == $i)? '<li><span class="pagenav">'.$i.'</span></li>':'<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
				}
			}
			
			if($paged < $pages ) {
				echo '<li class="pagination-next"><a href="'.get_pagenum_link($paged+1).'">'.__( 'Next', 'bearstore' ).'</a></li>';
				echo '<li class="pagination-end"><a href="'.get_pagenum_link($pages).'">'.__( 'End', 'bearstore' ).'</a></li>';
			}
			else {
				echo '<li class="pagination-next"><span class="pagenav">'.__( 'Next', 'bearstore' ).'</span></li>';
				echo '<li class="pagination-end"><span class="pagenav">'.__( 'End', 'bearstore' ).'</span></li>';
			}
			
			echo '</ul>';
			echo ''.__( 'Page', 'bearstore' ).' '.$paged.' '.__( 'of', 'bearstore' ).' '.$pages.'';
			echo "</div>\n";
		}
	}
}
/*--------------------------------------------------------------------------------------------------
	ADD CUSTOM WIDGETS
--------------------------------------------------------------------------------------------------*/
function override_woocommerce_widgets() { 
  if ( class_exists( 'WC_Widget_Best_Sellers' ) ) {
    unregister_widget( 'WC_Widget_Best_Sellers' ); 
    register_widget( 'Nova_Widget_Best_Sellers' );
  }
  if ( class_exists( 'WC_Widget_Top_Rated_Products' ) ) {
    unregister_widget( 'WC_Widget_Top_Rated_Products' ); 
    register_widget( 'Nova_Widget_Top_Rated_Products' );
  }
  if ( class_exists( 'WC_Widget_Recent_Reviews' ) ) {
    unregister_widget( 'WC_Widget_Recent_Reviews' ); 
    register_widget( 'Nova_Widget_Recent_Reviews' );
  }
}

add_action('widgets_init', create_function('', 'return register_widget("NovaWidgetRecentWorks");'));
add_action('widgets_init', create_function('', 'return register_widget("NovaWidgetRecentBlog");'));
add_action( 'widgets_init', 'override_woocommerce_widgets', 15 );
add_action('widgets_init', create_function('', 'return register_widget("Nova_Widget_Prducts_Tab_List");'));
add_action('widgets_init', create_function('', 'return register_widget("Nova_Widget_Cart");'));
add_action('widgets_init', create_function('', 'return register_widget("Nova_Widget_Product_Search");'));

add_action( 'wp_enqueue_scripts', 'remove_gridlist_styles', 30 );
function remove_gridlist_styles() {
	wp_dequeue_style( 'grid-list-button' );
}
add_theme_support( 'woocommerce' );

// $atts['comlumn'];
if ( ! function_exists( 'prtfl_view_columns' ) ) {
	function prtfl_view_columns( $atts ) {
		$content = '<div class="prtfl_portfolio_block">';
		$args = array(
			'post_type'					=> 'portfolio',
			'post_status'				=> 'publish',
			'orderby'						=> 'date',
			'order'							=> 'DESC',
			);
		query_posts( $args );

        // Set our terms list orderby and order
		$terms = get_terms( 'portfolio_technologies' ) ;
        // If there are multiple terms in use, then run through our display list
        if( count( $terms ) > 1 )  {
            $content .= '<ul class="arconix-portfolio-features">';
            
            //if( $heading)
                //$display_list .= "<li class='arconix-portfolio-category-title'>{$heading}</li>";

            $content .= '<li class="active"><a href="javascript:void(0)" class="all">' . __( 'All', 'acp' ) . '</a></li>';

            // Break each of the items into individual elements and modify the output
            $term_list = '';        
            foreach( $terms as $term ) {
                $term_list .= '<li><a href="javascript:void(0)" class="' . $term->slug . '">' . $term->name . '</a></li>';
            }

            // Return our modified list
            $content .= $term_list . '</ul>';

            // Allow users to filter how the 'features' are displayed
            //$return = apply_filters( 'arconix_portfolio_display_list', $display_list );
        }
		
		if (!isset($atts['column'])){$atts['column']=1;}
		
		if ($atts['column']==1){
			$class='column1';
			$imageclass = 'style="width:490px"';
		}else{
			$class='column'.$atts['column'];
			$imageclass = '';
		}
		
		$content .= '<ul class="arconix-portfolio-grid">';
		
		$count = 0;
		
		while ( have_posts() ) : the_post();
			
			
			$terms = wp_get_object_terms( get_the_ID(), 'portfolio_technologies' ) ;
			
			$content .= '<li class="'.$class.' portfolio-item" data-id="id-' . get_the_ID() . '" data-type="';
	        if( $terms ) {
	            foreach ( $terms as $term ) {
	                $content .= $term->slug . ' ';
	            }
	        }
	        
	        $content .= '">';
			
		 
			$content .= '
			<div class="portfolio_content">
				<div class="entry">';
					global $post;
					$meta_values				= get_post_custom($post->ID);
					$post_thumbnail_id	= get_post_thumbnail_id( $post->ID );
					if( empty ( $post_thumbnail_id ) ) {
						$args = array(
							'post_parent' => $post->ID,
							'post_type' => 'attachment',
							'post_mime_type' => 'image',
							'numberposts' => 1
						);
						$attachments				= get_children( $args );
						$post_thumbnail_id	= key($attachments);
					}
					$image_large				= wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
					$image						= wp_get_attachment_image_src( $post_thumbnail_id, 'portfolio-thumb' );
					$image_alt				= get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
					$image_desc 			= get_post($post_thumbnail_id);
					$image_desc				= $image_desc->post_content;
					if( get_option( 'prtfl_postmeta_update' ) == '1' ) {
						$post_meta		= get_post_meta( $post->ID, 'prtfl_information', true);
						$date_compl		= $post_meta['_prtfl_date_compl'];
						if( ! empty( $date_compl ) && 'in progress' != $date_compl) {
							$date_compl		= explode( "/", $date_compl );
							$date_compl		= date( get_option( 'date_format' ), strtotime( $date_compl[1]."-".$date_compl[0].'-'.$date_compl[2] ) );
						}
						$link					= $post_meta['_prtfl_link'];
						$short_descr	= $post_meta['_prtfl_short_descr'];
					}
					else{
						$date_compl		= get_post_meta( $post->ID, '_prtfl_date_compl', true );
						if( ! empty( $date_compl ) && 'in progress' != $date_compl) {
							$date_compl		= explode( "/", $date_compl );
							$date_compl		= date( get_option( 'date_format' ), strtotime( $date_compl[1]."-".$date_compl[0].'-'.$date_compl[2] ) );
						}
						$link					= get_post_meta($post->ID, '_prtfl_link', true);
						$short_descr	= get_post_meta($post->ID, '_prtfl_short_descr', true); 
					} 

					$content .= '<div class="portfolio_thumb">
						<div class="quickview-box">
							<a class="nolightbox quickview_small" id="portfolio-item-'.$post->ID.'" rel="portfolio_fancybox" href="'.$image_large[0].'"><i class="icon-search"> </i>&nbsp;</a>
						</div>
						<div class="quickshow-box">
							<a class="quickshow_small" href="'.get_permalink().'"><i class="icon-eye"> </i>&nbsp;</a>
						</div>
								<a href="'.get_permalink().'"><img src="'.$image[0].'" width="'.$image[1].'" alt="'.$image_alt.'" /></a>
					</div>
					<div class="item_title">
							<a href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a>
					</div>
					<div class="portfolio_short_content">
						 <!-- .item_title -->';

						$content .= '<p>'.get_the_content().'</p>
					</div> <!-- .portfolio_short_content -->
				</div> <!-- .entry -->';
			$content .= '<div class="prtfl_clear"></div></div> <!-- .portfolio_content -->';
			$content .= '</li>';
			
			$count++;
		endwhile; 		
		$content .= '</div> <!-- .prtfl_portfolio_block -->';
		$content .= '</ul>';
		$content .= '<script type="text/javascript">
				(function($){
					$(document).ready(function(){
						$("a[rel=portfolio_fancybox]").live("mouseenter", function(){
							$("a[rel=portfolio_fancybox]").fancybox({
								\'transitionIn\'		: \'elastic\',
								\'transitionOut\'		: \'elastic\',
								\'titlePosition\' 	: \'inside\',
								\'speedIn\'					:	500, 
								\'speedOut\'				:	300,
								\'titleFormat\'		: function(title, currentArray, currentIndex, currentOpts) {
									return \'<span id="fancybox-title-inside">\' + (title.length ? title + \'<br />\' : \'\') + \'Image \' + (currentIndex + 1) + \' / \' + currentArray.length + \'</span>\';
								}
							});
						});
					});
				})(jQuery);
				</script>';
			$content .= '<div id="portfolio_pagenation">';
			if( function_exists( 'prtfl_pagination' ) ) prtfl_pagination();
			$content .=	 '</div>';
		wp_reset_query();
		return $content;
	}
}
add_shortcode('portfolio_view_columns', 'prtfl_view_columns');

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
 
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	if($woocommerce->cart->cart_contents_count){
	?>
	<span class="cart_circle active"><span class="count"><span class="count-box"><?php echo sprintf(_n('%d', $woocommerce->cart->cart_contents_count, ''));?></span></span><i class="icon-bag"></i></span>
	<?php
	}else{
	?>
	<span class="cart_circle"><span class="count" style="display:none"><span class="count-box"><?php echo sprintf(_n('%d', $woocommerce->cart->cart_contents_count, ''));?></span></span><i class="icon-bag"></i></span>	
	<?php
	}
	$fragments['span.cart_circle'] = ob_get_clean();
	return $fragments;
}
    //add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat') ); //for future use
    
    
if ( ! function_exists( 'get_product_search' ) ) {

	/**
	 * Output Product search forms.
	 *
	 * @access public
	 * @subpackage	Forms
	 * @param bool $echo (default: true)
	 * @return void
	 */
	function get_product_search( $echo = true  ) {
		do_action( 'get_product_search'  );

		$search_form_template = locate_template( 'product-search.php' );
		if ( '' != $search_form_template  ) {
			require $search_form_template;
			return;
		}

		$form = '<form role="search" method="get" id="search_mini_form" action="' . esc_url( home_url( '/'  ) ) . '">
			<div class="form-search">
				<label class="screen-reader-text" for="search">' . __( 'Search for:', 'woocommerce' ) . '</label>
				<input type="text" class="input-text" value="' . get_search_query() . '" name="s" id="search" placeholder="' . __( 'Search for products', 'woocommerce' ) . '" />
				<button class="button" id="searchsubmit" title="Search" type="submit"><i class="icon-search"></i></button>
				<input type="hidden" name="post_type" value="product" />
			</div>
		</form>';

		if ( $echo  )
			echo apply_filters( 'get_product_search', $form );
		else
			return apply_filters( 'get_product_search', $form );
	}
}

// Add link compare:

if( class_exists( 'YITH_Woocompare_Frontend' ) ) {
	$wc_compare = new YITH_Woocompare_Frontend();
	
    /**
     *  Add the link to compare
     */
     
    function nova_add_compare_details_link( $product_id = false, $args = array() ) {
    	global $wc_compare;
        extract( $args );

        if ( ! $product_id ) {
            global $product;
            $product_id = isset( $product->id ) && $product->exists() ? $product->id : 0;
        }

        // return if product doesn't exist
        if ( empty( $product_id ) ) return;

        $is_button = !isset( $button_or_link ) || !$button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

        printf( '<a href="%s" class="%s" data-product_id="%d">%s</a>', $wc_compare->add_product_url( $product_id ), 'compare_details_overhead', $product_id, ( __( '<i class="icon-compare"></i> ADD TO COMPARE', 'yit' ) ) );
    }
		
	add_action( 'nova_compare_details_link', 'nova_add_compare_details_link', 3 );
     
    function nova_add_compare_link( $product_id = false, $args = array() ) {
    	global $wc_compare;
        extract( $args );

        if ( ! $product_id ) {
            global $product;
            $product_id = isset( $product->id ) && $product->exists() ? $product->id : 0;
        }

        // return if product doesn't exist
        if ( empty( $product_id ) ) return;

        $is_button = !isset( $button_or_link ) || !$button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

        printf( '<a href="%s" class="%s" data-product_id="%d">%s</a>', $wc_compare->add_product_url( $product_id ), 'compare_overhead', $product_id, ( __( '<i class="icon-compare"></i>', 'yit' ) ) );
    }
	
	
	add_action( 'nova_compare_link', 'nova_add_compare_link', 3 );
	
    //add_action( 'woocommerce_single_product_summary', array( $wc_compare, 'add_compare_link' ), 35 );
    //add_action( 'woocommerce_after_shop_loop_item', array( $wc_compare, 'add_compare_link' ), 20 );	
}
if( class_exists( 'YITH_WCWL' ) ) {
	
    function nova_add_to_wishlist_details_button( $url, $product_type, $exists ) {   
        global $yith_wcwl, $product;
                 
        $label = apply_filters( 'yith_wcwl_button_label', get_option( 'yith_wcwl_add_to_wishlist_text' ) );
        $icon = get_option( 'yith_wcwl_add_to_wishlist_icon' ) != 'none' ? '<i class="' . get_option( 'yith_wcwl_add_to_wishlist_icon' ) . '"></i> ADD TO WISHLIST' : ''; 
        
        $classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';
        
        $html  = '<div class="yith-wcwl-add-to-wishlist">'; 
            $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row
            
            $html .= $exists ? ' hide" style="display:none;"' : ' show"';
            
            $html .= '><a href="' . $yith_wcwl->get_addtowishlist_url() . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' ><i class="icon-wishlist"></i> ADD TO WISHLIST</a>';
            $html .= '<img src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" class="ajax-loading" id="add-items-ajax-loading" alt="" width="16" height="16" style="visibility:hidden" />';
            $html .= '</div>';
        
        $html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> <a href="' . $url . '">' . apply_filters( 'yith-wcwl-browse-wishlist-label', __( '<i class="icon-ok"></i> ADDED TO WISHLIST', 'yit' ) ) . '</a>';
        $html .= '<img src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" class="ajax-loading" id="add-items-ajax-loading" alt="" width="16" height="16" style="visibility:hidden" /></div>';
        $html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"> <a href="' . $url . '">' . apply_filters( 'yith-wcwl-browse-wishlist-label', __( '<i class="icon-ok"></i> ADDED TO WISHLIST', 'yit' ) ) . '</a>';
        $html .= '<img src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" class="ajax-loading" id="add-items-ajax-loading" alt="" width="16" height="16" style="visibility:hidden" /></div>';
        //$html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';
        
        $html .= '</div>';
        
        echo $html;
    }
	
	
	function nova_wishlist_details_link (){
        global $product, $yith_wcwl;
        
        $html = nova_add_to_wishlist_details_button( $yith_wcwl->get_wishlist_url(), $product->product_type, $yith_wcwl->is_product_in_wishlist( $product->id ) ); 
        
        echo $html;
	}
	add_action( 'nova_wishlist_details_link', 'nova_wishlist_details_link', 3 );
	
    function nova_add_to_wishlist_button( $url, $product_type, $exists ) {   
        global $yith_wcwl, $product;
                 
        $label = apply_filters( 'yith_wcwl_button_label', get_option( 'yith_wcwl_add_to_wishlist_text' ) );
        $icon = get_option( 'yith_wcwl_add_to_wishlist_icon' ) != 'none' ? '<i class="' . get_option( 'yith_wcwl_add_to_wishlist_icon' ) . '"></i>' : ''; 
        
        $classes = get_option( 'yith_wcwl_use_button' ) == 'yes' ? 'class="add_to_wishlist single_add_to_wishlist button alt"' : 'class="add_to_wishlist"';
        
        $html  = '<div class="yith-wcwl-add-to-wishlist">'; 
            $html .= '<div class="yith-wcwl-add-button';  // the class attribute is closed in the next row
            
            $html .= $exists ? ' hide" style="display:none;"' : ' show"';
            
            $html .= '><a href="' . $yith_wcwl->get_addtowishlist_url() . '" data-product-id="' . $product->id . '" data-product-type="' . $product_type . '" ' . $classes . ' ><i class="icon-wishlist"></i></a>';
            $html .= '<img src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" class="ajax-loading" id="add-items-ajax-loading" alt="" width="16" height="16" style="visibility:hidden" />';
            $html .= '</div>';
        
        $html .= '<div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;"> <a href="' . $url . '">' . apply_filters( 'yith-wcwl-browse-wishlist-label', __( '<i class="icon-ok"></i>', 'yit' ) ) . '</a>';
        $html .= '<img src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" class="ajax-loading" id="add-items-ajax-loading" alt="" width="16" height="16" style="visibility:hidden" /></div>';
        $html .= '<div class="yith-wcwl-wishlistexistsbrowse ' . ( $exists ? 'show' : 'hide' ) . '" style="display:' . ( $exists ? 'block' : 'none' ) . '"> <a href="' . $url . '">' . apply_filters( 'yith-wcwl-browse-wishlist-label', __( '<i class="icon-ok"></i>', 'yit' ) ) . '</a>';
        $html .= '<img src="' . esc_url( admin_url( 'images/wpspin_light.gif' ) ) . '" class="ajax-loading" id="add-items-ajax-loading" alt="" width="16" height="16" style="visibility:hidden" /></div>';
        //$html .= '<div style="clear:both"></div><div class="yith-wcwl-wishlistaddresponse"></div>';
        
        $html .= '</div>';
        
        echo $html;
    }
	
	
	function nova_wishlist_link (){
        global $product, $yith_wcwl;
        
        $html = nova_add_to_wishlist_button( $yith_wcwl->get_wishlist_url(), $product->product_type, $yith_wcwl->is_product_in_wishlist( $product->id ) ); 
        
        echo $html;
	}
	add_action( 'nova_wishlist_link', 'nova_wishlist_link', 3 );
		
}



/*--------------------------------------------------------------------------------------------------
	SHORT CODES
--------------------------------------------------------------------------------------------------*/
// [our_brand]

function our_brand($params = array(), $content = null){
	extract(shortcode_atts(array(
	  'id' => 'brand-list',
	  'colums' => 4,
	  'title' => 'Our Brands',
	  'url' => '#'
	), $params));
	$content = do_shortcode($content);
	
	$our_brand = '<div class="brand-slider-container">
				<div class="brand-slider">
					<div class="who-we-are">
						<div class="row-fluid who-center">
							<h1 class="title">'.$title.'</h1>
						</div>
					</div>
					<div class="'.$id.' flexslider products-list-home">
						<ul class="slides">'.$content.'</ul>	
					</div>
				</div>
			</div>

	<script type="text/javascript">
		jQuery.noConflict();
			jQuery(window).load(function() {
				jQuery(\'.'.$id.'\').flexslider({
				animation: "slide",
				easing: "easeInQuart",
				animationLoop: false,
				slideshow: false,
				animationSpeed: 400,						
				pauseOnHover: true,
				controlNav: false,
				itemWidth: 235,
				prevText: "<i class=\"icon-left-open-big\"></i>",
				nextText: "<i class=\"icon-right-open-big\"></i>",  
				itemMargin: 18
			  });
			});
	</script>';
	return $our_brand;	
}
add_shortcode( 'our_brand', 'our_brand' );

function our_brand_item($params = array(), $content = null){
	extract(shortcode_atts(array(
	  'image_url' => '',
	  'name' => 'Name',
	  'url' => '#'
	), $params));
	$content = do_shortcode($content);
	
	$our_brand_item = '<li><img src="'.$image_url.'" alt="" /></li>';
	return $our_brand_item;
}
add_shortcode( 'our_brand_item', 'our_brand_item' );

// [team_member]

function our_team($params = array(), $content = null){
 extract(shortcode_atts(array(
  'title' => '',
  'columns' => 4,
  'style' => 1
 ), $params));
 
 $content = do_shortcode($content);
 
 if ($style==1){
 	$our_team = '<div class="who-we-are">';
	if ($title) {
	$our_team .= '	<div class="row-fluid who-center">
					<h1 class="title">'.$title.'</h1>
					</div>';
	}
	$our_team .= ''.$content.'</div>';
 }
 
 if ($style==2){
 	$our_team = '<ul class="ourteam">'.$content.'</ul>';
 }
 
 return $our_team;
}
add_shortcode( 'our_team', 'our_team' );

function team_member($params = array(), $content = null) {
 extract(shortcode_atts(array(
  'image_url' => '',
  'name' => 'Name',
  'url' => '#'
 ), $params));
 
 $content = do_shortcode($content);
 $team_member = '
  <div class="who-top">
   <img src="'.$image_url.'" alt="" border="0" />
   <h2>'.$name.'</h2>
   <p>'.$content.'</p>
   <a href="'.$url.'">READ MORE</a>
  </div>
 ';
 return $team_member;
}
add_shortcode( 'team_member', 'team_member' );

// [team_member2]
function team_member2($params = array(), $content = null) {
 extract(shortcode_atts(array(
  'image_url' => '',
  'name' => 'Name',
  'class' => ''
 ), $params));
 
 $content = do_shortcode($content);
 $team_member2 = '
	<li class="'.$class.'">
	<img src="'.$image_url.'" border="0" />
	<div class="left-content">
	<a href="#"><i class="icon-email"></i></a>
	<a href="#"><i class="icon-skype"></i></a>
	<a href="#"><i class="icon-facebook-rect"></i></a>
	<a href="#"><i class="icon-twitter-rect"></i></a>
	</div>
	<div class="right-content">'.$name.'</div>
	</li>
 ';
 return $team_member2;
}
add_shortcode( 'team_member2', 'team_member2' );

// [team_member3]
function team_member3($params = array(), $content = null) {
 extract(shortcode_atts(array(
  'image_url' => '',
  'name' => 'Name',
  'job' => ''
 ), $params));
 
 $content = do_shortcode($content);
 $team_member3 = '
	<div class="circle-hover">
	<span><p class="big-text">'.$name.'</p> '.$job.'</span>
	<img src="'.$image_url.'" alt="">
	</div>
	<div class="clear"></div>
 ';
 return $team_member3;
}
add_shortcode( 'team_member3', 'team_member3' );

// [custom_slider]

function custom_slider ($params = array(), $content = null) {
	 extract(shortcode_atts(array(
	  'slider_id' => 'custom-slider',
	  'item_width' => '',
	  'item_margin' => '',
	  'control_nav' => 'hide',
	  'direction_nav' => 'hide'
	 ), $params));
	 
	 $content = do_shortcode($content);
	 
	 $custom_slider = '<script type="text/javascript">
	    jQuery(window).load(function(){
	      var width_doc = jQuery(document).width();
		  if(width_doc >960){
		      jQuery(\'.'.$slider_id.'\').flexslider({
		        animation: "slide",
		        animationLoop: false,';
				if ($item_width > 0) {
					$custom_slider .= 'itemWidth: '.$item_width.',';
				}
				if ($item_margin > 0) {
					$custom_slider .= 'itemMargin: '.$item_margin.',';
				}
				if ($control_nav=='hide') {
					$custom_slider .= 'controlNav: false,';
				}
				else{
					$custom_slider .= 'controlNav: true,';
				}
				if ($direction_nav=='hide') {
					$custom_slider .= 'directionNav: false,';
				}
				else {
					$custom_slider .= 'directionNav: true,';
				}
				$custom_slider .= '
		        prevText: "<i class=\"icon-left-open-big\"></i>",
		        nextText: "<i class=\"icon-right-open-big\"></i>" 
		      });
		  	}
			if(width_doc <900){
		      jQuery(\'.'.$slider_id.'\').flexslider({
		        animation: "slide",
		        animationLoop: false,';
				if ($item_width > 0) {
					$custom_slider .= 'itemWidth: '.$item_width.',';
				}
				if ($item_margin > 0) {
					$custom_slider .= 'itemMargin: '.$item_margin.',';
				}

				$custom_slider .= 'controlNav: false,';

				$custom_slider .= 'directionNav: false,';

				$custom_slider .= '
		        prevText: "<i class=\"icon-left-open-big\"></i>",
		        nextText: "<i class=\"icon-right-open-big\"></i>" 
		      });
			}
	    });
	  </script>
	  <div class="'.$slider_id.' flexslider products-list-home custom-list"><ul class="slides">'.$content.'</ul></div>';
	 return $custom_slider;
}
add_shortcode( 'custom_slider', 'custom_slider' );

function custom_slider_item ($params = array(), $content = null) {
	extract(shortcode_atts(array(
	  'image_url' => '',
	  'name' => 'Name',
	  'url' => '#'
	), $params));
	$content = do_shortcode($content);
	
	$custom_slider_item = '<li>'.$content.'</li>';
	return $custom_slider_item;
}

add_shortcode( 'custom_slider_item', 'custom_slider_item' );

function simple_banner ($params = array(), $content = null) {
	extract(shortcode_atts(array(
	  'title' => '',
	  'name' => 'Name',
	  'url' => '#',
	  'style' => 1
	), $params));
	$content = do_shortcode($content);
	
	if ($style==1){
		$simple_banner = '<div class="homev5-content banner-first">
			<h2>'.$title.'</h2>
			<p>'.$content.'</p>
			<div class="purchase-title">
				<h3><a href="#">Purchase Now!</a></h3>
			</div>
		</div>';
	}
	if ($style==2){
		$simple_banner = '<div class="container banner-second">
			<h3>'.$title.'</h3>
			<p>'.$content.'</p>
		</div>';
	}

	return $simple_banner;
}

add_shortcode( 'simple_banner', 'simple_banner' );

add_filter('loop_shop_per_page',  'custom_products_per_page');
function custom_products_per_page() {
    return Helix::Param('woo_product_per_page');
}
add_theme_support('automatic-feed-links');

function nova_content_meta($cls='') {

    $str = 'Posted in {category} on {date} by {author}';
    if (true) {

        $str = preg_replace("/\{icon-(.*?)\}/", '<i class="icon-$1"></i>', $str);

        $category_list = get_the_category_list( __( ', ', _THEME ) );

        $comment = '';

        $date = sprintf( '<time datetime="%1$s">%2$s</time>',
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date( 'F d, Y' ) )
        );

        $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" role="author">%3$s</a></span>',
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_attr( sprintf( __( 'View all posts by %s', _THEME ), get_the_author() ) ),
            get_the_author()
        );

        if ( comments_open() ) : 

            $num_comments = get_comments_number();

            if ( $num_comments == 0 ) {
                $_comments = __('0 Comment', _THEME);
            } elseif ( $num_comments > 1 ) {
                $_comments = $num_comments . __(' Comments', _THEME);
            } else {
                $_comments = __('1 Comment', _THEME);
            }

            $comment = '<a href="' . get_comments_link() . '">' . $_comments. '</a>';
            endif; // comments_open()

        $arr = array(
            '{category}' => $category_list,
            '{date}' => $date,
            '{author}' => $author,
            '{comment}' => $comment
        );
        return '<div class="entry-meta muted '.$cls.'" role="contentinfo">' . strtr($str,$arr) . '</div>';
    }
}
function has_visible_widgets( $sidebar_id ) {

    // First check if sidebar has any widgets
    if ( is_active_sidebar($sidebar_id) ) {
        // Use PHP output buffer to load
        // the sidebar into a variable
        ob_start();
        dynamic_sidebar($sidebar_id);
        $sidebar = ob_get_contents();
        ob_end_clean();
        // Return false if sidebar is empty
        if ($sidebar == "") return false;
    } else {
        return false;
    }

    // Return true if sidebar is not empty
    return true;

}


if(!function_exists('nova_recent_posts_sc')) {
	function nova_recent_posts_sc( $atts, $content="" ){
		extract(shortcode_atts(array(
					'title' => 'Recent Posts',
					'block_id' => 'rencent_post',
				   'number' => '10',
				   'show_date' => true
		), $atts));		

		if ( ! $number )
 			$number = 10;
		
		$show_date = isset( $show_date ) ? $show_date : false;
		
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		
		ob_start();
		
		echo '<div class="rencent_post sp-widget widget_recent_entries"><h3>'.$title.'<i class="icon-right-open-big"></i></h3>';

		if ($r->have_posts()) {
		?>
		
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
			<?php if ( $show_date ) : ?>
				<span class="post-date"><?php echo get_the_date(); ?></span>
			<?php endif; ?>
			</li>
		<?php endwhile; ?>
		</ul>
		
		<?php
		}
		
		echo '</div>';
		
		return ob_get_clean();
	}
	add_shortcode( 'nova_recent_posts', 'nova_recent_posts_sc' );
}

if(!function_exists('nova_recent_works_sc')) {
	function nova_recent_works_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
					'title' => 'Recent Works',
					'block_id' => 'recent-works',
					'thumb_type' =>'portfolio-thumb', // 'portfolio-photo-thumb' => Postrait Thumbnail
					'class' => '', // flat_left
				   'number' => '10',
				   'order_by' => 'date', // 'modified', 'rand', 'title'
				   'order' => 'DESC' // or ASC
		), $atts));

		if ( ! $number )
 			$number = 10;
		
		$post_type = 'portfolio';
		
		$query = new WP_Query("posts_per_page=$number&post_type=$post_type&orderby=$order_by&order=$order");
		$c = 1;
		if($thumb_type=='portfolio-photo-thumb') { $class2='vertical'; } else { $class2=''; }
		
		ob_start();
		
		echo '<div class="recent_works sp-widget '.$class.' '.$class2.'"><div class="recent-works-title"><h3>'.$title.'</h3></div>';
		
		?>

	    <?php if($thumb_type=='portfolio-thumb'){ ?>                    
	                        
		<script type="text/javascript">
					  
	    jQuery(window).load(function(){
	      jQuery('.<?php echo $block_id; ?>').flexslider({
	        animation: "slide",
	        itemWidth: 231,
	        itemMargin: 18,
	        animationLoop: true,
			controlNav: false,
			directionNav: true,
	        prevText: "<i class=\"icon-left-open-big\"></i>",
	        nextText: "<i class=\"icon-right-open-big\"></i>" 
	      });
	    });
	    </script>
	    <?php }else{ ?>
		<script type="text/javascript">
					  
	    jQuery(window).load(function(){
	      jQuery('.<?php echo $block_id; ?>').flexslider({
	        animation: "slide",
	        itemWidth: 188,
	        itemMargin: 10,
	        animationLoop: true,
			controlNav: false,
			directionNav: true,
	        prevText: "<i class=\"icon-left-open-big\"></i>",
	        nextText: "<i class=\"icon-right-open-big\"></i>" 
	      });
	    });
	    </script>
		
		<?php } ?>

		<div class="<?php echo $block_id; ?> flexslider products-list-home">
            <ul class="slides">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <li>
                        <?php if($c <= $number){ $c++; /* Formato para vistas primarias*/ ?>
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <span class="alignleft">
										<?php
										$post_thumbnail_id	= get_post_thumbnail_id();
										$image = wp_get_attachment_image_src($post_thumbnail_id,$thumb_type);
										$image_large = wp_get_attachment_image_src($post_thumbnail_id,'large'); 
										?>
										<div class="quickview-box">
											<a class="hs-rsp-popup quickview_small" href="<?php echo $image_large[0]; ?>"><i class="icon-search"> </i>&nbsp;</a>
										</div>
										<div class="quickshow-box">
											<a class="quickshow_small" href="<?php echo get_permalink(); ?>"><i class="icon-eye"> </i>&nbsp;</a>
										</div>
                                        <a href="<?php the_permalink() ?>"><img src="<?php echo $image[0]; ?>" border="0" /></a>
                                    </span>
                                <?php endif ?>
                                <?php if($thumb_type=='portfolio-thumb'){ ?>

                                <h4 class="nova-widget-recent-works-tittle nova-widget-recent-works-tittle-main">   <a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a></h4>

								<?php } ?>


                        <?php } ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>

		<script type="text/javascript">
		(function($){
			$(document).ready(function(){
				$("a[rel=portfolio_fancybox]").fancybox({
					'transitionIn'		: 'elastic',
					'transitionOut'		: 'elastic',
					'titlePosition' 	: 'inside',
					'speedIn'					:	500, 
					'speedOut'				:	300,
					'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
						return '<span id="fancybox-title-inside">' + (title.length ? title + '<br />' : '') + 'Image ' + (currentIndex + 1) + ' / ' + currentArray.length + '</span>';
					}
				});
			});
		})(jQuery);
		</script>

		<?php
		
		echo '</div>';	
		
		return ob_get_clean();		
	}
	add_shortcode( 'nova_recent_works', 'nova_recent_works_sc' );
}

if(!function_exists('nova_recent_blog_sc')) {
	function nova_recent_blog_sc( $atts, $content="" ){

		extract(shortcode_atts(array(
					'title' => 'Recent Blog',
					'cat_id' => '1',
					'thumb_type' =>'thumbnail', // 'medium' , 'large'
					'class' => '', // flat_left four_col
				   'number' => '2',
				   'order_by' => 'date', // 'modified', 'rand', 'title'
				   'order' => 'DESC' // or ASC
		), $atts));

		if ( ! $number )
 			$number = 2;
		
		$query = new WP_Query("posts_per_page=$number&cat=$cat_id&orderby=$order_by&order=$order");
		$cat_nombre=get_cat_name($cat_id);
		$c = 1;
		
		ob_start();

		echo '<div class="recent_blog sp-widget '.$class.'"><div class="recent-blog-title"><h3>'.$title.'</h3></div>';
		?>

        <ul class="recent-blog-list">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
				<li <?php if ($c == $number) echo 'class="last"'; ?>>
					<?php if($c <= $number){ $c++; /* Formato para vistas primarias*/ ?>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <span class="alignleft">
                                    <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail($thumb_type); ?></a>
                                </span>
                            <?php endif ?>

                            <h4 class="nova-widget-recent-blog-tittle nova-widget-recent-blog-tittle-main">   <a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a></h4>
							<span class="post-date"><em class="icon-window"></em><?php echo " On ". get_the_time("d M, Y"); ?> <em class="icon-user"></em><?php echo " by " . get_the_author(); ?></span>

                            <?php the_excerpt(); ?>
							<a class="nova-widget-recent-blog-sml" href="<?php the_permalink(); ?>"><?php _e("READ MORE",'nova-widget-recent-blog'); ?></a>
								
					<?php } ?>
				</li>
            <?php endwhile; ?>
    	</ul>

		<?php
		echo '</div>';
		
		return ob_get_clean();
	}
	add_shortcode( 'nova_recent_blog', 'nova_recent_blog_sc' );
}
	/* LANGUAGE FLAGS
	================================================== */
	
	function language_flags() {
		
		$language_output = "";
		
		if (function_exists('icl_get_languages')) {
		    $languages = icl_get_languages('skip_missing=0&orderby=code');
		    if(!empty($languages)){
		        foreach($languages as $l){
		            $language_output .= '<li>';
		            if($l['country_flag_url']){
		                if(!$l['active']) {
		                	$language_output .= '<a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /><span class="language name">'.$l['translated_name'].'</span></a>'."\n";
		                } else {
		                	$language_output .= '<div class="current-language"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /><span class="language name">'.$l['translated_name'].'</span></div>'."\n";
		                }
		            }
		            $language_output .= '</li>';
		        }
		    }
	    } else {
	    	//echo '<li><div>No languages set.</div></li>';
	    	$flags_url = get_template_directory_uri() . '/images/flags';
	    	$language_output .= '<li><a href="#">DEMO - EXAMPLE PURPOSES</a><li><a href="#"><span class="language name">German</span></a></li><li><div class="current-language"><span class="language name">English</span></div></li><li><a href="#"><span class="language name">Spanish</span></a></li><li><a href="#"><span class="language name">French</span></a></li>'."\n";
	    }
	    
	    return $language_output;
	}


    function get_excerpt($count){
      $permalink = get_permalink($post->ID);
      $excerpt = get_the_content();
      $excerpt = strip_tags($excerpt);
      $excerpt = substr($excerpt, 0, $count);
      $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
      $excerpt = $excerpt;
      return $excerpt;
    }
