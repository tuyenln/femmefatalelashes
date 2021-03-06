<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

//[Accordion]
if(!function_exists('accordion_sc')) {
	$accordionArray = array();
	function accordion_sc( $atts, $content="" ){
		global $accordionArray;
		
		$params = shortcode_atts(array(
			  'id' => 'accordion1'
		 ), $atts);
		
		do_shortcode( $content );
		
		$html = '<div class="accordion" id="' . $params['id'] . '">';
		
		//Accordions
		foreach ($accordionArray as $key=>$accordion) {
			$html .= '<div class="accordion-group">';
			
			$html .= '<div class="accordion-heading">';
			$html .= '<a class="accordion-toggle' . ( ($key==0) ? "" : " collapsed") . '" data-toggle="collapse" data-parent="#' . $params['id'] . '" href="#'.Helix::slug($accordion['title']).'"><strong>';
			$html .= $accordion['title'];
			$html .= '</strong></a>';
			$html .= '</div>';//end Accordion Heading
			
			$html .= '<div id="'.Helix::slug($accordion['title']).'" class="accordion-body collapse' . ( ($key==0) ? " in" : "") . '">';
			$html .= '<div class="accordion-inner">';
			$html .= $accordion['content'];
			$html .= '</div>';
			$html .= '</div>';//end Accordion Content
			
			$html .= '</div>';//end accordion group
			
		}
		
		$html .='</div>';
	
		$accordionArray = array();	
		return $html;
	}
	
	add_shortcode( 'accordion', 'accordion_sc' );
		
	//Accordion Items
	function accordion_item_sc( $atts, $content="" ){
		global $accordionArray;
		$accordionArray[] = array('title'=>$atts['title'], 'content'=>$content);
	}

	add_shortcode( 'accordion_item', 'accordion_item_sc' );			
}