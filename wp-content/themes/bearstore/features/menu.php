<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
?>

<div class="mobile-menu pull-right hidden-desktop" id="sp-moble-menu">
	<h1>
		<span>Menu</span>
		<a class="nav-box highlight" href="javascript:void(0);">menu</a>
		<span class="clearfix"></span>
	</h1>
	<div id="mobi-nav-content" style="display:none">
	<?php
	if ( has_nav_menu( 'primary' ) ) :
		wp_nav_menu(
			array(
				'theme_location' 	=> 'primary',
				'menu_class' 		=> 'accordion',
				'menu_id'			=> ' ',
				'walker' 			=> new HelixMenuWalker(),
				'container'       	=> 'ul',
				'container_class' 	=> ''
			)
		);
	else :
		echo "Please create and choose Main menu.";
	endif;
	?>
	</div>
</div>

<nav id="sp-main-menu" class="visible-desktop" role="navigation"><?php
	if ( has_nav_menu( 'primary' ) ) :
		wp_nav_menu(
			array(
				'theme_location' 	=> 'primary',
				'menu_class' 		=> 'sp-menu level-0',
				'walker' 			=> new HelixMenuWalker(),
				'container'       	=> 'div',
				'container_class' 	=> 'main-navigation'
			)
		);
	else :
		echo "Please create and choose Main menu.";
	endif;
	?></nav>

<script type="text/javascript">
	jQuery(function($){
		mainmenu();
		
		$(window).on('resize',function(){
			mainmenu();
		});
		
		function mainmenu() {
			$('.sp-menu').spmenu({
				startLevel: 0,
				direction:'<?php echo Helix::Param('direction'); ?>',
				initOffset: {
					x:0,
					y:0
				},
				subOffset: {
					x:0,
					y:0
				},
				center:0
			});
		}
		
		//Mobile Menu
		$('#sp-main-menu > > ul').mobileMenus({
			defaultText:'--Select Menu--',
			className: 'open-close',
			appendTo: 'li.parent'
		});
		
	});
	
jQuery(document).ready(function(){
	jQuery(".nav-box").click(function(){
		/*if(jQuery("#mobi-nav-content").css("display") == "block"){
			jQuery("#mobi-nav-content").css("display","none");
		}else{
			jQuery("#mobi-nav-content").css("display","block");
		}*/
		jQuery("#mobi-nav-content").animate({height:'toggle'});
		return!1
	});
	jQuery(".open-close").each(function(){
		if(jQuery(this).parent().hasClass("active")){
			jQuery(this).parent().find('.sp-submenu-wrap').css("display","block");
		}
		jQuery(this).click(function(){
			if(jQuery(this).parent().hasClass("active")){
				jQuery(this).parent().removeClass("active");
				jQuery(this).parent().find('.sp-submenu-wrap').animate({height:'toggle'});
			}else{
				jQuery(this).parent().addClass("active");
				jQuery(this).parent().find('.sp-submenu-wrap').animate({height:'toggle'});

			}
			return!1
		});

	});
});
/**
* jQuery Mobile Menus 
*/
(function($){
        $.fn.mobileMenus = function(options) {

            var defaults = {
                defaultText: 'Navigate to...',
                className: 'select-menu',
                subMenuClass: 'menu-item',
                subMenuDash: '-',
                appendTo: '#sp-mmenu'
            },
            settings = $.extend( defaults, options ),
            el = $(this);
            mobileMenu=$(settings.appendTo);

            this.each(function(){
                    // ad class to submenu list
                    el.find('ul').addClass(settings.subMenuClass);

                    // Create base menu
                    $('<em />',{
                            'class' : settings.className,
                    }).appendTo( mobileMenu );

                    // Create default option
                    /*$('<li />', {
                            "value"		: '#',
                            "text"		: settings.defaultText
                    }).appendTo( '.' + settings.className );*/



            }); // End this.each

            return this;

        };

})(jQuery);
	
</script>