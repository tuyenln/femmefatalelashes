<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
?>

</section><!-- #sp-main -->

<?php if (has_visible_widgets( 'bottom' ) ) : ?>
<div class="footer-info-top">
	<div class="footer-info container">
			<?php //dynamic_sidebar('bottom'); ?>

	</div>
</div>
<?php else:?>
Please add widget to here
<?php endif; ?>	
	
<!--bottom-->
	
<section id="sp-bottom-wrapper">
	<div class="container">
	    <div class="row-fluid">
			<div class="span7 about-responsive">
					<?php //dynamic_sidebar('bottom1'); ?>
					<?php echo do_shortcode('[alpine-phototile-for-instagram id=300 user="femmefatalelashes" src="user_liked" imgl="instagram" style="cascade" col="3" size="Th" num="6" shadow="1" highlight="1" align="left" max="60" nocredit="1"]'); ?>
			</div>
			<div class="span4">
				<?php dynamic_sidebar('bottom2'); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span7">
				<?php if (has_visible_widgets( 'bottom3' ) ) : ?>
				<?php dynamic_sidebar('bottom3'); ?>
				<?php else:?>
				<div class=" sp-widget widget_text" id="text-9">
					<div class="textwidget">
						Please add widget to here
				</div>						
				<?php endif;?>
			</div>
			<div class="span5 nova-newsletter-box">
			<?php if (has_visible_widgets( 'bottom4' ) ) : ?>
				<?php dynamic_sidebar('bottom4'); ?>
			<?php else:?>
		<div class="newsletter-box">
			Please add widget to here

		</div>

			<?php endif;?>	
			</div>
		</div>
	</div>

</section>

<footer id="sp-footer-wrapper" role="contentinfo">
	<div class="container">
		<div class="row-fluid">
			<div class="span6">
					<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
                    <?php else: ?>
                        Please create and choose footer menu.
                    <?php endif; ?>

			</div>		
			<div class="span6 footer-right">
				<?php
					Helix::addFeatures('footer');
				?>
			</div>
		</div>
	</div>
</footer>
<?php Helix::addFeatures('analytics'); ?>
<a id="toTop" href="#">
<span id="toTopHover" style="opacity: 0;"></span>
To Top
</a>
<?php wp_footer(); ?>
</body>
</html>