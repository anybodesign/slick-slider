<?php
/**
 * Plugin Name: Slick Slider
 * Description: Create a nice slider using Slick by Ken Wheeler. 
 * Version: 1.1
 * Author: Thomas Villain - Anybodesign
 * Author URI: http://anybodesign.com/
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

register_activation_hook( __FILE__, 'any_slick_flush_rewrites' );

function any_slick_flush_rewrites() {
	any_slick_custom_posts();
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );


// i18n

load_plugin_textdomain( 'slick-slider', false, basename( dirname( __FILE__ ) ) . '/languages' );



/* ------------------------------------------
// Enqueue JS -------------------------------
--------------------------------------------- */


function any_add_slick_js() {
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
add_action('wp_enqueue_scripts', 'any_add_slick_js');


function any_print_slick_script() {

print '
<script>
jQuery(document).ready(function() {
	jQuery(".slicky-slides").slick({
		autoplay: false,
		autoplaySpeed: 4000,
		arrows: true,
		dots: true,
		fade: false,
		adaptiveHeight: true
	});
});
</script>
';
}
add_action('wp_footer', 'any_print_slick_script', 100);


/* ------------------------------------------
// Enqueue CSS ------------------------------
--------------------------------------------- */


function any_add_slick_css() {
	
	wp_register_style(
		'slick', 
	    plugins_url( '/css/slick.css' , __FILE__ ),
		array(), 
		'1.3.15', 
		false
	);
	wp_enqueue_style( 'slick' );
}    
add_action('wp_enqueue_scripts', 'any_add_slick_css');


function any_print_slick_css() {
 
print '<style>
.slicky-slides .slick-prev:before, .slicky-slides .slick-next:before {color: #666666;}
.slicky-slides .slick-dots li button:before,
.slicky-slides .slick-dots li.slick-active button:before {color: color: #666666;}
 </style>';
}
add_action('wp_head', 'any_print_slick_css', 100);



/* ------------------------------------------
// Admin Options ----------------------------
--------------------------------------------- */

/* Nothing yet
	 
//include( dirname( __FILE__ ) . '/admin/settings.php' );



/* ------------------------------------------
// Slider Output ----------------------------
--------------------------------------------- */


function any_get_slick_slider() { ?>

 
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
					<figcaption class="slicky-caption">
						<?php the_content(); ?>
					</figcaption>
				</figure>
	        </div>     
	    
		<?php endwhile; ?> 
 
    </div>
	
	<?php endif; wp_reset_query(); ?>

 
<?php }

 
 
/* Shortcode */
 
function any_slick_insert_slider() {
 
	ob_start();
		any_get_slick_slider();
	return ob_get_clean();	
	
}
add_shortcode('slick_slider', 'any_slick_insert_slider');
 
 
 
/* Template tag */
 
function any_slick_slider() {
 
    print any_get_slick_slider();
}