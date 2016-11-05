<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#MEGA MENU STYLES
function htheme_attach_menu_styles(){

	if(isset($GLOBALS['htheme_global_object']) && $GLOBALS['htheme_global_object']['settings']['megamenu']['enable'] == 'true'){

		#ENQUEUE
		wp_enqueue_media();
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('jquery');

		#STYLES
		wp_enqueue_style('htheme-mega-menu-styles', get_template_directory_uri() . '/htheme/assets/menu/css/herotheme_mega_menu_styles.css');
		wp_enqueue_style('htheme-mega-menu-fonts', get_template_directory_uri() . '/htheme/assets/menu/css/herotheme_mega_menu_fonts.css');

		#SCRIPTS
		wp_enqueue_script('htheme-tweenmax', get_template_directory_uri() . '/htheme/assets/js/greensock/TweenMax.js');
		wp_enqueue_script('htheme-mega-components-functions', get_template_directory_uri() . '/htheme/assets/js/components.js');
		wp_enqueue_script('htheme-mega-menu-functions', get_template_directory_uri() . '/htheme/assets/menu/js/functions.js');

	}

}

add_action( 'admin_print_styles-nav-menus.php' , 'htheme_attach_menu_styles' );

#MEGA MENU STYLES
function htheme_attach_menu_frontend_styles(){

	#STYLES
	wp_enqueue_style( 'htheme-mega-menu-styles', get_template_directory_uri().'/htheme/assets/menu/css/herotheme_mega_front.css' );

}

add_action( 'wp_enqueue_scripts', 'htheme_attach_menu_frontend_styles', 20 );

#MEGA MENU SCRIPTS
function htheme_attach_menu_frontend_scripts(){

	#LOAD SCRIPT FUNCTIONS FILE
	wp_enqueue_script( 'htheme-mega-menu-script', get_template_directory_uri().'/htheme/assets/menu/js/functions.frontend.js', array( 'jquery' ) );

}

add_action( 'wp_footer', 'htheme_attach_menu_frontend_scripts' );

#MEGA MENU SETTINGS
function htheme_attach_menu_settings(){ ?>

	<script>
		var global_theme_directory = '<?php echo get_template_directory_uri() ?>';
	</script>

	<div class="htheme_pages_overlay">
		<div class="htheme_overlay_heading"><?php esc_html_e('Select Pages','invogue'); ?></div>
		<div class="htheme_overlay_close"></div>
		<div class="htheme_load_pages"></div>
	</div>

	<div class="htheme_mega_menu_settings" data-mega-toggle="open" data-item-id="">
		<div class="htheme_mega_menu_col_2">

			<div class="htheme_nav_top"><?php esc_html_e('Mega Menu Settings','invogue'); ?></div>
			<div class="htheme_nav_items">
				<div class="htheme_nav_button" data-id="htheme_layout">
					<?php esc_html_e('Content & Layout','invogue'); ?>
				</div>
				<div class="htheme_nav_button" data-id="htheme_background">
					<?php esc_html_e('Background','invogue'); ?>
				</div>
				<div class="htheme_nav_button" data-id="htheme_styling">
					<?php esc_html_e('Styling','invogue'); ?>
				</div>
				<div class="htheme_nav_button" data-id="htheme_mobile">
					<?php esc_html_e('Mobile','invogue'); ?>
				</div>
			</div>

		</div>
		<div class="htheme_mega_menu_col_10">

			<div class="htheme_menu_detail">
				<a><?php esc_html_e('Home','invogue'); ?></a> <span><?php esc_html_e('menu-item-','invogue'); ?><a></a></span>
				<div class="htheme_menu_controller">
					<div class="htheme_menu_close"></div>
					<div class="htheme_menu_save htheme_no_save"><?php esc_html_e('Save Settings','invogue'); ?></div>
				</div>
			</div>

			<div class="htheme_loading">
				<div class="sk-folding-cube">
					<div class="sk-cube1 sk-cube"></div>
					<div class="sk-cube2 sk-cube"></div>
					<div class="sk-cube4 sk-cube"></div>
					<div class="sk-cube3 sk-cube"></div>
				</div>
			</div>

			<div class="htheme_menu_load htheme_mega_menu_col_12">

				<!-- ALL THE SECTIONS WILL BE HERE -->
				<div class="htheme_container" id="htheme_layout">
					<div class="htheme_content_header">
						<div class="htheme_layout_select_holder" data-columns="1">
							<div></div>
						</div>
						<div class="htheme_layout_select_holder" data-columns="2">
							<div></div>
							<div></div>
						</div>
						<div class="htheme_layout_select_holder" data-columns="3">
							<div></div>
							<div></div>
							<div></div>
						</div>
						<div class="htheme_layout_select_holder" data-columns="4">
							<div></div>
							<div></div>
							<div></div>
							<div></div>
						</div>
						<div class="htheme_enable_mega" data-enable="off">
							<span><?php esc_html_e('Enable Mega Menu','invogue'); ?></span>
						</div>
					</div>
					<div class="htheme_content">
						<div class="htheme_layout_columns"></div>
					</div>
				</div>

				<!-- ALL THE SECTIONS WILL BE HERE -->
				<div class="htheme_container" id="htheme_background">
					<div class="htheme_content_header">
						<?php esc_html_e('Background','invogue'); ?>
					</div>
					<div class="htheme_content">
						<div class="htheme_mega_menu_col_2">
							<label> <?php esc_html_e('Background image','invogue'); ?> </label>
							<input name="htheme_bg_image" id="htheme_bg_image" value="Image here">
							<div class="htheme_media_uploader htheme_media_button" data-connect="htheme_bg_image" data-multiple="false" data-size="full">
								<?php esc_html_e('Upload', 'invogue'); ?>
							</div>
						</div>
						<div class="htheme_mega_menu_col_1">
							<div class="htheme_img_place htheme_media_uploader" data-connect="htheme_bg_image">
								<div class="htheme_image_holder" id="image_htheme_bg_image"></div>
							</div>
						</div>
						<div class="htheme_mega_menu_col_3">
							<label> <?php esc_html_e('Background position','invogue'); ?> </label>
							<select name="htheme_bg_position" id="htheme_bg_position">
								<option value=""><?php esc_html_e('Please select a position','invogue'); ?></option>
								<option value="left top"><?php esc_html_e('Left/Top','invogue'); ?></option>
								<option value="left center"><?php esc_html_e('Left/Center','invogue'); ?></option>
								<option value="left bottom"><?php esc_html_e('Left/Bottom','invogue'); ?></option>
								<option value="right top"><?php esc_html_e('Right/Top','invogue'); ?></option>
								<option value="right center"><?php esc_html_e('Right/Center','invogue'); ?></option>
								<option value="right bottom"><?php esc_html_e('Right/Bottom','invogue'); ?></option>
								<option value="center top"><?php esc_html_e('Center/Top','invogue'); ?></option>
								<option value="center center"><?php esc_html_e('Center','invogue'); ?></option>
								<option value="center bottom"><?php esc_html_e('Center/Bottom','invogue'); ?></option>
							</select>
						</div>
						<div class="htheme_mega_menu_col_2">
							<label> <?php esc_html_e('Background color','invogue'); ?> </label>
							<input name="htheme_bg_color" id="htheme_bg_color" class="htheme_color_picker">
						</div>
						<div class="htheme_mega_menu_col_1">
							<label> <?php esc_html_e('Background size','invogue'); ?> </label>
							<select name="htheme_bg_size" id="htheme_bg_size">
								<option value="inherit"><?php esc_html_e('Default','invogue'); ?></option>
								<option value="contain"><?php esc_html_e('Contain','invogue'); ?></option>
								<option value="cover"><?php esc_html_e('Cover','invogue'); ?></option>
							</select>
						</div>
					</div>
					<div class="htheme_content_header">
						<?php esc_html_e('Overwrite styles','invogue'); ?>
					</div>
					<div class="htheme_content">
						<div class="htheme_mega_menu_col_3">
							<label> <?php esc_html_e('Font primary color (Overwrites defaults)','invogue'); ?></label>
							<input name="htheme_font_primary" id="htheme_font_primary" class="htheme_color_picker">
						</div>
						<div class="htheme_mega_menu_col_3">
							<label> <?php esc_html_e('Font secondary color (Overwrites defaults)','invogue'); ?></label>
							<input name="htheme_font_secondary" id="htheme_font_secondary" class="htheme_color_picker">
						</div>
					</div>
				</div>

				<!-- ALL THE SECTIONS WILL BE HERE -->
				<div class="htheme_container" id="htheme_styling">
					<div class="htheme_content_header">
						<?php esc_html_e('Styling','invogue'); ?>
					</div>
					<div class="htheme_content">
						<div class="htheme_mega_menu_col_1">
							<label> <?php esc_html_e('Title underline','invogue'); ?> </label>
							<select name="htheme_underline" id="htheme_underline">
								<option value="yes"><?php esc_html_e('Yes','invogue'); ?></option>
								<option value="no"><?php esc_html_e('No','invogue'); ?></option>
							</select>
						</div>
						<div class="htheme_mega_menu_col_3">
							<label> <?php esc_html_e('Title underline color','invogue'); ?></label>
							<input name="htheme_underline_color" id="htheme_underline_color" class="htheme_color_picker">
						</div>
					</div>
					<div class="htheme_content_header">
						Border
					</div>
					<div class="htheme_content">
						<div class="htheme_mega_menu_col_1">
							<label> <?php esc_html_e('Enable border','invogue'); ?></label>
							<select name="htheme_border" id="htheme_border">
								<option value="yes"><?php esc_html_e('Yes','invogue'); ?></option>
								<option value="no"><?php esc_html_e('No','invogue'); ?></option>
							</select>
						</div>
						<div class="htheme_mega_menu_col_3">
							<label> <?php esc_html_e('Border color','invogue'); ?> </label>
							<input name="htheme_border_color" id="htheme_border_color" class="htheme_color_picker">
						</div>
					</div>
					<div class="htheme_content_header">
						Shadow
					</div>
					<div class="htheme_content">
						<div class="htheme_mega_menu_col_1">
							<label> <?php esc_html_e('Enable shadow','invogue'); ?> </label>
							<select name="htheme_shadow" id="htheme_shadow">
								<option value="yes"><?php esc_html_e('Yes','invogue'); ?></option>
								<option value="no"><?php esc_html_e('No','invogue'); ?></option>
							</select>
						</div>
						<div class="htheme_mega_menu_col_3">
							<label> <?php esc_html_e('Shadow color','invogue'); ?> </label>
							<input name="htheme_shadow_color" id="htheme_shadow_color" class="htheme_color_picker">
						</div>
					</div>
				</div>

				<!-- ALL THE SECTIONS WILL BE HERE -->
				<div class="htheme_container" id="htheme_mobile">
					<div class="htheme_content_header">
						<?php esc_html_e('Mobile settings','invogue'); ?>
					</div>
					<div class="htheme_content">
						<div class="htheme_mega_menu_col_1">
							<label> <?php esc_html_e('Show on mobile','invogue'); ?> </label>
							<select name="htheme_mobile_enable" id="htheme_mobile_enable">
								<option value="yes"><?php esc_html_e('Yes','invogue'); ?></option>
								<option value="no"><?php esc_html_e('No','invogue'); ?></option>
							</select>
						</div>
					</div>
				</div>
				
			</div>

		</div>
	</div>

<?php }

add_action( 'admin_footer-nav-menus.php' , 'htheme_attach_menu_settings');