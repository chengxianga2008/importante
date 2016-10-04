<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO SETTINGS PANEL FOR BACKEND
class htheme_settings{

	#CONSTRUCT
	public function __construct(){

		#HOOK ADMIN MENU TO BACKEND
		add_action( 'admin_menu', array( $this, 'htheme_admin_menu') );

	}

	#SETUP HERO THEME ADMIN MENU
	public function htheme_admin_menu() {

		add_theme_page(
			'inVogue',
			esc_html__('inVogue Settings', 'invogue'),
			'manage_options',
			'htheme_settings',
			array($this, 'htheme_settings_page')
		);

	}

	#HERO THEME SETTINGS PAGE
	public function htheme_settings_page(){

		#THEME DETAILS
		$htheme = wp_get_theme();

		echo '<script>';
			echo 'var global_theme_directory = "' . get_template_directory_uri() . '"';
		echo '</script>';
		echo '<!-- MAIN WRAPPER :: START -->';
			echo '<div class="htheme_main_wrapper">';
				echo '<div class="htheme_top_container">';
					echo '<div class="htheme_logo_container">';
						echo '<img alt="'.esc_html__('Hero Theme Framework','invogue').'" src="'.esc_url(get_template_directory_uri().'/htheme/assets/images/settings/hf_logo.png').'">';
					echo '</div>';
					echo '<div class="htheme_top_content">';
						echo '<div class="htheme_heading">';
						echo '</div>';
						echo '<div class="htheme_button_container">';
							echo '<div class="htheme_version_label">'.esc_html__('Version', 'invogue') . ': ' .$htheme->Version.'</div>';
							echo '<div class="htheme_button htheme_green_btn htheme_save_button">';
								echo '<div class="htheme_inner_save">'.esc_html__('Save changes', 'invogue').'</div>';
								echo '<div class="htheme_loading">';
									echo '<div class="htheme_double_bounce1"></div><div class="htheme_double_bounce2"></div>';
								echo '</div>';
							echo '</div>';
							//echo '<div class="htheme_button htheme_dark_btn">Reset to defaults</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="htheme_inner_container">';
					echo '<div class="htheme_sidebar">';
						echo '<ul class="htheme_control_nav">';
							echo $this->htheme_get_sidebar_data();
						echo '</ul>';
						echo '<ul>';
							echo '<li class="documentation"><span><a href="'.esc_url('http://heroplugins.com/product/invogue-theme/documentation/').'" target="_blank">'.esc_html__('Documentation', 'invogue').'</a></span></li>';
						echo '</ul>';
						echo '<div class="htheme_heroplugins_logo">';
							echo '<a href="'.esc_url('http://heroplugins.com/').'" target="_blank"><img alt="'.esc_html__('HeroPlugins','invogue').'" style="border:none" src="'.esc_url(get_template_directory_uri().'/htheme/assets/images/settings/hp_logo.png').'"></a>';
						echo '</div>';
					echo '</div>';
					echo '<div class="htheme_control">';
						echo '<!-- ROW -->';
						echo '<div class="htheme_page_loader"><div class="htheme_double_bounce1"></div><div class="htheme_double_bounce2"></div></div>';
							echo '<div class="htheme_form_controls">';
								echo '<!-- LOAD -->';
							echo '</div>';
						echo '<!-- ROW -->';
						echo '<div class="htheme_button htheme_green_btn htheme_save_button">';
							echo '<div class="htheme_inner_save">'.esc_html__('Save changes', 'invogue').'</div>';
							echo '<div class="htheme_loading">';
								echo '<div class="htheme_double_bounce1"></div><div class="htheme_double_bounce2"></div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="htheme_status_holder"></div>';
		echo '<!-- MAIN WRAPPER :: END -->';

	}

	//<li><span>General Settings</span></li>
	public function htheme_get_sidebar_data(){

		#GET OPTION DATA
		$options = get_option( 'hero_theme_options' );

		#CONVERT STRING BACK TO ARRAY
		$data = unserialize($options);

		#SETUP HTML FOR SIDEBAR
		$html = '';

		#LOOP EACH SECTION
		foreach($data['settings'] as $sidebar){
			$html .= '<li data-slug="'. esc_attr($sidebar['_slug']) .'" class="'. esc_attr($sidebar['_slug']) .'"><span>' . esc_html($sidebar['_label']) . '</span></li>';
		}

		#RETURN SIDEBAR HTML
		return $html;

	}

}