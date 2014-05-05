<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
//[Testimonial]
if(!function_exists('testimonial_sc')) {
	function testimonial_sc( $atts, $content="" ){
	
		extract(shortcode_atts(array(
				   'name' => 'John Doe',
				   'image_url' => '',
				   'designation' => '',
				   'email' => 'email@email.com',
				   'url' => 'http://www.joomshaper.com/'
			 ), $atts));
	?>
		<div class="testimonial">
			<div class="row-fluid span12">
				<div class="span2">
					<img class="img-circle" alt="<?php echo $name; ?>" src="<?php echo $image_url; ?>" width="96">
					<div class="img-circle-desc"><strong><?php echo $name; ?></strong> - <?php echo $designation; ?></div>
				</div>
				<div class="span10">
					<p class="testimonial-content"><?php echo $content; ?></p>
				</div>
			</div>
		</div>
		<?php 
	}
		add_shortcode( 'testimonial', 'testimonial_sc' );
}

