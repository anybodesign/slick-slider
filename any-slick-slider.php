<?php
/*
Plugin Name: Slick Slider
Description: Create a nice responsive slider using Slick by Ken Wheeler. 
Plugin URI: https://github.com/anybodesign/slick-slider/
Version: 1.1
Author: Thomas Villain - Anybodesign
Author URI: http://anybodesign.com/
License: GPL2
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined('ABSPATH') or die('°_°’'); 



/* ------------------------------------------
// Some constants ---------------------------
--------------------------------------------- */


define ('SLKS_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define ('SLKS_NAME', 'Slick Slider');
define ('SLKS_VERSION', '1.1');


// Require the Custom post type

require_once('any-slick-slider-cpt.php');


// Flush Rewrite

register_activation_hook( __FILE__, 'any_slks_flush_rewrites' );

function any_slks_flush_rewrites() {
	any_slick_custom_posts();
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );


// i18n

load_plugin_textdomain( 'slick-slider', false, basename( dirname( __FILE__ ) ) . '/languages' );



/* ------------------------------------------
// Enqueue JS -------------------------------
--------------------------------------------- */


function any_slks_add_js() {
    if (!is_admin()) {
	
	    wp_enqueue_script( 
	    	'slick', 
	    	plugins_url( '/js/slick.min.js' , __FILE__ ),
	    	array('jquery'), 
	    	'1.3.15', 
	    	true
	    );
	}
}    
add_action('wp_enqueue_scripts', 'any_slks_add_js');


function any_slks_print_script() {

// Default values as vars

$dots = get_option('any_slks_dots', 1);
if ($dots) { $dotsok = 'true'; } else { $dotsok = 'false'; }
$arrows = get_option('any_slks_arrows', 1);
if ($arrows) { $arrowsok = 'true'; } else { $arrowsok = 'false'; }
$auto = get_option('any_slks_auto', 1);
if ($auto) { $autook = 'true'; } else { $autook = 'false'; }
$speed = get_option('any_slks_speed', 4000);
if ($speed) { $speedok = $speed; } else { $speedok = 4000; }
$style = get_option('any_slks_style', 'false');
$height = get_option('any_slks_height', 1);
if ($height) { $heightok = 'true'; } else { $heightok = 'false'; }


print '
<script>
jQuery(document).ready(function() {
	jQuery(".slicky-slides").slick({
		autoplay: '.$autook.',
		autoplaySpeed: '.$speedok.',
		arrows: '.$arrowsok.',
		dots: '.$dotsok.',
		fade: '.$style.',
		adaptiveHeight: '.$heightok.'
	});
});
</script>
';
}
add_action('wp_footer', 'any_slks_print_script', 100);


/* ------------------------------------------
// Enqueue CSS ------------------------------
--------------------------------------------- */


function any_slks_add_css() {
	
	wp_register_style(
		'slick', 
	    plugins_url( '/css/slick.css' , __FILE__ ),
		array(), 
		'1.3.15', 
		false
	);
	wp_enqueue_style( 'slick' );
}    
add_action('wp_enqueue_scripts', 'any_slks_add_css');



function any_slks_print_css() {

$dotscolor = get_option('any_slks_dotscolor');
if ($dotscolor) { $dotscolorok = $dotscolor; } else { $dotscolorok = '#000000'; }
$arrowscolor = get_option('any_slks_arrowscolor');
if ($arrowscolor) { $arrowscolorok = $arrowscolor; } else { $arrowscolorok = '#000000'; }
 
 
print '<style>
.slicky-slides .slick-prev:before, .slicky-slides .slick-next:before {
	color: '.$arrowscolorok.';
}
.slicky-slides .slick-dots li button:before,
.slicky-slides .slick-dots li.slick-active button:before {
	color: '.$dotscolorok.';
}
 </style>';
}

add_action('wp_head', 'any_slks_print_css', 100);



/* ------------------------------------------
// Admin Options ----------------------------
--------------------------------------------- */


include( dirname( __FILE__ ) . '/admin/settings.php' );

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'any_slks_plugin_settings_link' );

function any_slks_plugin_settings_link($links) {
	 $mylinks = array(
	 	'<a href="' . admin_url( 'options-general.php?page=slick_slider' ) . '">'.__('Settings').'</a>', 
	 	'<a href="' . admin_url( 'edit.php?post_type=slick-image' ) . '">'.__('Create the slides','slick-slider').'</a>'
	 );
	return array_merge( $links, $mylinks );
}


/* ------------------------------------------
// Slider Output ----------------------------
--------------------------------------------- */


function any_slks_get_slider() { ?>

 
    <?php $slick_query = array(
	    'post_type' => 'slick-image'
    );
    $query = new WP_Query($slick_query); ?>

    <?php if ($query->have_posts()) : ?>

 	<div class="slicky-slides">
    
	 	<?php while ($query->have_posts()) : $query->the_post(); ?> 
        
	        <div class="slicky-item">
		        <figure class="slicky-figure">
				<?php the_post_thumbnail('large'); ?>
					
					<?php $caption = get_the_content(); ?>
					<?php if ($caption) { ?>
					<figcaption class="slicky-caption">
						<?php the_content(); ?>
					</figcaption>
					<?php } ?>
					
				</figure>
	        </div>     
	    
		<?php endwhile; ?> 
 
    </div>
	
	<?php endif; wp_reset_query(); ?>

 
<?php }

 
 
/* Shortcode */
 
function any_slks_insert_slider() {
 
	ob_start();
		any_slks_get_slider();
	return ob_get_clean();	
	
}
add_shortcode('slick_slider', 'any_slks_insert_slider');
 
 
 
/* Template tag */
 
function any_slks_slider() {
 
    print any_slks_get_slider();
}