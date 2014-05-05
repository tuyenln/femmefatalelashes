<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
?>


<?php 
if (Helix::Param('showcp'))
	echo '<span class="copyright">'.str_replace('{year}', date('Y'), Helix::Param('copyright')).'</span>';
?>


<?php if (Helix::Param('wpcredit')) : ?>
	<span class="powered-by"><?php _e('Powered by ','bearstore') ?><a target="_blank" href="<?php echo esc_url( __( 'http://wordpress.org/','bearstore') ); ?>"><?php _e( 'Wordpress','bearstore'); ?></a></span>
<?php endif; ?>

<?php if(Helix::Param('validator')) : ?>
	<span class="validation-link"><?php _e('Valid', 'bearstore') ?> <a target="_blank" href="http://validator.w3.org/check/referer">XHTML</a> <?php _e('and', 'bearstore') ?> <a target="_blank" href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">CSS</a></span>
<?php endif;