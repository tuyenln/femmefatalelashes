<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
?>


<?php 
if (Helix::Param('showcp')) {
	echo '<span class="copyright">'.str_replace('{year}', date('Y'), Helix::Param('copyright')).'</span>';
	} else {
		echo 'Copyright 2013 BearStore Theme. Designed by <a href="http:/novaworks.net" title="Novaworks">Novaworks</a>.';
	}
?>


<?php if (Helix::Param('wpcredit')) : ?>
	<span class="powered-by"><?php _e('Powered by ','bearstore') ?><a target="_blank" href="<?php echo esc_url( __( 'http://wordpress.org/','bearstore') ); ?>"><?php _e( 'Wordpress','bearstore'); ?></a></span>
<?php endif; ?>

<?php if(Helix::Param('validator')) : ?>


<?php endif;