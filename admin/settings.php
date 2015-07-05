<?php defined('ABSPATH') or die(); 


add_action( 'admin_menu', 'any_slks_add_admin_menu' );
add_action( 'admin_init', 'any_slks_settings_init' );


function any_slks_add_admin_menu(  ) { 

	add_options_page( 
		'Slick Slider', 
		'Slick Slider', 
		'manage_options', 
		'slick_slider', 
		'any_slks_options_page'
	);

}


function any_slks_settings_init(  ) { 

	add_settings_section(
		'any_slks_plugin_page_section', 
		__( 'Slider Settings', 'slick-slider' ), 
		'any_slks_settings_section_callback', 
		'any_slks_plugin_page'
	);
	
	
		// Style and Autoplay
		
		add_settings_field( 
			'any_slks_style', 
			__( 'Slide or Fade ?', 'slick-slider' ), 
			'any_slks_style_render', 
			'any_slks_plugin_page', 
			'any_slks_plugin_page_section' 
		);
		register_setting( 'any_slks_plugin_page', 'any_slks_style' );
		
		add_settings_field( 
			'any_slks_auto', 
			__( 'Autoplay', 'slick-slider' ), 
			'any_slks_auto_render', 
			'any_slks_plugin_page', 
			'any_slks_plugin_page_section' 
		);
		register_setting( 'any_slks_plugin_page', 'any_slks_auto' );
		
		add_settings_field( 
			'any_slks_speed', 
			__( 'Transition speed', 'slick-slider' ), 
			'any_slks_speed_render', 
			'any_slks_plugin_page', 
			'any_slks_plugin_page_section' 
		);
		register_setting( 'any_slks_plugin_page', 'any_slks_speed' );
		

		// Arrows and Dots
		
		add_settings_field( 
			'any_slks_arrows', 
			__( 'Navigation arrows', 'slick-slider' ), 
			'any_slks_arrows_render', 
			'any_slks_plugin_page', 
			'any_slks_plugin_page_section' 
		);
		register_setting( 'any_slks_plugin_page', 'any_slks_arrows' );
	
	
		add_settings_field( 
			'any_slks_arrowscolor', 
			__( 'Arrows color', 'slick-slider' ), 
			'any_slks_arrowscolor_render', 
			'any_slks_plugin_page', 
			'any_slks_plugin_page_section' 
		);
		register_setting( 'any_slks_plugin_page', 'any_slks_arrowscolor' );
		
		add_settings_field( 
			'any_slks_dots', 
			__( 'Pagination dots', 'slick-slider' ), 
			'any_slks_dots_render', 
			'any_slks_plugin_page', 
			'any_slks_plugin_page_section' 
		);
		register_setting( 'any_slks_plugin_page', 'any_slks_dots' );
	
	
		add_settings_field( 
			'any_slks_dotscolor', 
			__( 'Dots color', 'slick-slider' ), 
			'any_slks_dotscolor_render', 
			'any_slks_plugin_page', 
			'any_slks_plugin_page_section' 
		);
		register_setting( 'any_slks_plugin_page', 'any_slks_dotscolor' );
		
		// Height
		
		add_settings_field( 
			'any_slks_height', 
			__( 'Adaptive height', 'slick-slider' ), 
			'any_slks_height_render', 
			'any_slks_plugin_page', 
			'any_slks_plugin_page_section' 
		);
		register_setting( 'any_slks_plugin_page', 'any_slks_height' );
		

}


// Style and Autoplay

function any_slks_style_render(  ) { 

	$options = get_option( 'any_slks_style', 'false' );
	?>
	<select name='any_slks_style'>
		<option value='false' <?php selected( $options, 'false' ); ?>>Slide</option>
		<option value='true' <?php selected( $options, 'true' ); ?>>Fade</option>
	</select>

<?php

}


function any_slks_auto_render(  ) { 

	$options = get_option( 'any_slks_auto', 1 );
	?>
	<input type='checkbox' name='any_slks_auto' <?php checked( 1, $options, true ); ?> value='1'> <?php _e('Enable','slick-slider'); ?>
	<?php
}

function any_slks_speed_render(  ) { 

	$options = get_option( 'any_slks_speed', 4000 );
	?>
	<input type='text' name='any_slks_speed' value='<?php echo $options; ?>' placeholder='4000'>
	<?php
}


// Arrows and Dots 

function any_slks_arrows_render(  ) { 

	$options = get_option( 'any_slks_arrows', 1 );
	?>
	<input type='checkbox' name='any_slks_arrows' <?php checked( 1, $options, true ); ?> value='1'> <?php _e('Enable','slick-slider'); ?>
	<?php
}

function any_slks_arrowscolor_render(  ) { 

	$options = get_option( 'any_slks_arrowscolor', '#000000' );
	?>
	<input type='text' name='any_slks_arrowscolor' value='<?php echo $options; ?>' placeholder='#CCCCCC'>
	<?php
}

function any_slks_dots_render(  ) { 

	$options = get_option( 'any_slks_dots', 1 );
	?>
	<input type='checkbox' name='any_slks_dots' <?php checked( 1, $options, true ); ?> value='1'> <?php _e('Enable','slick-slider'); ?>
	<?php
}

function any_slks_dotscolor_render(  ) { 

	$options = get_option( 'any_slks_dotscolor', '#000000' );
	?>
	<input type='text' name='any_slks_dotscolor' value='<?php echo $options; ?>' placeholder='#CCCCCC'>
	<?php
}


// Height

function any_slks_height_render(  ) { 

	$options = get_option( 'any_slks_height', 1 );
	?>
	<input type='checkbox' name='any_slks_height' <?php checked( 1, $options, true ); ?> value='1'> <?php _e('Enable','slick-slider'); ?>
	<?php
}




function any_slks_settings_section_callback(  ) { 

	echo __( 'Choose options to customize your slider.', 'slick-slider' );

}



// The Admin page


function any_slks_options_page() { 

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	
	?>

<div class="wrap">
		
	<h2><?php echo SLKS_NAME; ?></h2>
	
	
	<h3><?php _e('Usage','slick-slider'); ?></h3>
		<p><?php _e('First, create your slides in "Slick Images". Enter the title and the featured image, the content will be used for the image caption.','slick-slider'); ?></p>
		<p><?php _e('Then, to output the slider, just add the shortcode <code>[slick_slider]</code> in a post or page, or use the function <code>&lt;?php any_slks_slider(); ?&gt;</code> in your theme templates.','slick-slider'); ?></p>
	
	
	
	<form action='options.php' method='post'>

		<?php
		settings_fields( 'any_slks_plugin_page' );
		do_settings_sections( 'any_slks_plugin_page' );
		submit_button();
		?>
		
	</form>


	<h3><?php _e('CSS customization','slick-slider'); ?></h3>			
	<p><?php _e('If you want to customize the output of the slider, here is the generated code:','slick-slider'); ?></p>
			
<pre>
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
&lt;div class=&quot;slicky-slides&quot;&gt;
   
   &lt;div class=&quot;slicky-item&quot;&gt;
        &lt;figure class=&quot;slicky-figure&quot;&gt;
        &lt;img src=&quot;your-image.jpg&quot; alt=&quot;image description&quot;&gt;
          &lt;figcaption class=&quot;slicky-caption&quot;&gt;
            Your slide content
          &lt;/figcaption&gt;
        &lt;/figure&gt;
   &lt;/div&gt;
   
&lt;/div&gt;
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
</pre>

	<p><?php _e('Your can override the class you need in your own stylesheet:','slick-slider'); ?></p>
	<ul>
		<li><code>.slicky-slides</code> : <?php _e('The slider container','slick-slider'); ?></li>
		<li><code>.slicky-item</code> : <?php _e('The slide','slick-slider'); ?></li>
		<li><code>.slicky-figure</code> : <?php _e('The image container','slick-slider'); ?></li>
		<li><code>.slicky-caption</code> : <?php _e('The caption container','slick-slider'); ?></li>
	</ul>



	<h3><?php _e('Credits','slick-slider'); ?></h3>
	
		<p><?php _e('This plugin is based on Slick, a jQuery plugin by Ken Wheeler. You can visit the official website here: <a href="https://kenwheeler.github.io/slick/" title="Slick official site">https://kenwheeler.github.io/slick/','slick-slider'); ?></a></p>

		<p><?php echo '<img src="' . SLKS_PATH .'/img/anybodesign-logo.svg" width="70" alt="logo anybodesign" style="vertical-align:middle" /> '; ?> 
		<?php _e('Made by <a href="http://anybodesign.com" title="graphic and web design">anybodesign.com</a> :)','slick-slider'); ?></p>

</div>
	
	<?php

}
