<?php defined('ABSPATH') or die(); ?>	
	
	<div class="wrap">
		<h2><?php _e('Slick Slider Settings','slick-slider'); ?></h2>			
			
			<h3><?php _e('How-to','slick-slider'); ?></h3>
			<p><?php _e('First, create your slides in "Slick Images". Add Title, content and a featured image.','slick-slider'); ?><br>
			<?php _e('Then add the slider shortcode <code>[slick_slider]</code> on a page or a post.','slick-slider'); ?></p>
			<p><?php _e('You can also call the function <code>&lt;?php slick_slider(); ?&gt;</code> in your theme templates.','slick-slider'); ?></p>
			
			
			<h3><?php _e('Slick options','slick-slider'); ?></h3>			
 
			<form action="options.php" method="post" name="options">
			<?php wp_nonce_field('update-options'); ?>
			
				<table class="form-table">
					<tbody>
						<tr>
							<th><?php _e('Slide or Fade ?','slick-slider'); ?></th>
							<td scope="row">
								<label><?php _e('Slider Effect','slick-slider'); ?></label> 
								<select name="slick_effect">
									<option value="false" <?php echo $slk_slide; ?>><?php _e('Slide','slick-slider'); ?></option>
									<option value="true" <?php echo $slk_fade; ?>><?php _e('Fade','slick-slider'); ?></option>
								</select>
							</td>
						</tr>
						
						<tr>
							<th><?php _e('Auto Play and Adaptive Height','slick-slider'); ?></th>
							<td scope="row">
								<input type="checkbox" <?php echo $slk_autoplay; ?>  id="slick_autoplay" name="slick_autoplay" value="true" /> <label for="slick_autoplay"><?php _e('Enable Auto Play','slick-slider'); ?></label>
								<br>
								<input type="checkbox" <?php echo $slk_height; ?>  id="slick_height" name="slick_height" value="false" /> <label for="slick_height"><?php _e('Enable Adaptive Height','slick-slider'); ?></label>
								
							</td>
						</tr>

						<tr>
							<th><?php _e('Speed','slick-slider'); ?></th>
							<td scope="row">
							<label for="slick_speed"><?php _e('Transition Speed: ','slick-slider'); ?></label> <input type="text" id="slick_speed" name="slick_speed" value="<?php echo $slk_speed; ?>" placeholder="4000" />
							</td>
						</tr>
						
						<tr>
							<th><?php _e('Navigation','slick-slider'); ?></th>
							<td scope="row">
								<input type="checkbox" <?php echo $slk_showarr; ?>  id="slick_showarr" name="slick_showarr" value="true" /> <label for="slick_showarr"><?php _e('Display Direction Arrows','slick-slider'); ?></label>
								<br>
								<input type="checkbox" <?php echo $slk_showdot; ?>  id="slick_showdot" name="slick_showdot" value="true" /> <label for="slick_showdot"><?php _e('Display Pagination Dots','slick-slider'); ?></label>
								
							</td>
						</tr>

						
						<tr>
							<th><?php _e('Colors','slick-slider'); ?></th>
							<td scope="row">
							<label><?php _e('Arrows color: ','slick-slider'); ?></label> <input type="text" name="slick_dircolor" value="<?php echo $slk_dircolor; ?>" placeholder="#666666" /><br>
							<label><?php _e('Dots color: ','slick-slider'); ?></label> <input type="text" name="slick_dotcolor" value="<?php echo $slk_dotcolor; ?>" placeholder="#666666" />
							</td>
						</tr>
						
					</tbody>
				</table>
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="slick_effect,slick_autoplay,slick_height,slick_showarr,slick_showdot,slick_speed,slick_showarr,slick_showdot,slick_dircolor,slick_dotcolor" />
			 
				<?php submit_button(); ?>
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
				<li><code>.slicky-item</code> : <?php _e('The slider slides','slick-slider'); ?></li>
				<li><code>.slicky-figure</code> : <?php _e('The image container','slick-slider'); ?></li>
				<li><code>.slicky-caption</code> : <?php _e('The content container','slick-slider'); ?></li>
			</ul>
			
			
			<h3><?php _e('Credits','slick-slider'); ?></h3>
			<p><?php _e('This plugin is based on Slick, a jQuery plugin by Ken Wheeler. You can visit the official website here: <a href="https://kenwheeler.github.io/slick/" title="Slick official site">https://kenwheeler.github.io/slick/','slick-slider'); ?></a></p>

			<p><?php echo '<img src="' . SLKS_PATH .'/img/anybodesign-logo.svg" width="70" alt="logo anybodesign" style="vertical-align:middle" /> '; ?> 
			<?php _e('Made by <a href="http://anybodesign.com" title="graphic and web design">anybodesign.com</a> :)','slick-gallery'); ?></p>
		
			
	</div>