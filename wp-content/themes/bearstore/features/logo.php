<?php
/**
 * @package Helix Framework
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2013 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/
?>

<?php if (Helix::Param('logo_type')=='css') { ?>
<a id="logo" style="width:308px; height:111px;" class="pagination-left" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"></a>

<?php } else if (Helix::Param('logo_type')=='text') { ?>

<a id="logo_text" class="pagination-centered" style="width:<?php echo Helix::Param('logo_width'); ?>px; height:<?php echo Helix::Param('logo_height'); ?>px" href="<?php echo esc_url( home_url( '/' ) ); ?>">
<?php if (Helix::Param('logo_text')) : ?>
<div class="logo-text"><?php echo Helix::Param('logo_text'); ?></div>
<?php endif; ?>
<?php if (Helix::Param('logo_slogan')) : ?>
<div class="logo-slogan"><?php echo Helix::Param('logo_slogan'); ?></div>
<?php endif; ?>
</a>

<?php  }else { ?>
<a rel="home" title="novaworks" href="<?php echo home_url('/'); ?>" class="pagination-centered" style="width:308px; height:111px" id="logo"></a>
<?php }?>