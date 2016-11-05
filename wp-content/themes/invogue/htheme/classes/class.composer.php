<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO COMPOSER CONTROL CLASS
class htheme_composer{

	#VARIABLES
	public $htheme_woo_content, $htheme_content, $htheme_array = [];

	#CONSTRUCT
	public function __construct(){

		#RUN HOOKS
		$this->htheme_hooks();

		#IF WOOCOMMERCE CLASS EXIST // INSTANTIATE WOO/CONTENT CLASS
		if ( class_exists( 'WooCommerce' ) ){
			$this->htheme_woo_content = new htheme_getwoo();
		}
		$this->htheme_content = new htheme_getcontent();

	}

	public function htheme_hooks(){

		// ~ SET ROW ICON

		$settings = array (
			'icon' => 'icon_element_row'
		);
		vc_map_update( 'vc_row', $settings );

		$settings = array (
			'icon' => 'icon_element_text_block'
		);
		vc_map_update( 'vc_column_text', $settings );

		$settings = array (
			'icon' => 'icon_element_icon'
		);
		vc_map_update( 'vc_icon', $settings );

		// ~ REMOVE DEFAULTS

		#REMOVE DEFAULT ELEMENTS
		add_filter( 'vc_build_admin_page', array($this,'htheme_remove_default_elements'), 11 );

		#ACTION FOR REMOVING DEFAULT TEMPLATES
		add_filter( 'vc_load_default_templates', array($this, 'htheme_my_custom_template_modify_array') );

		// ~ ELEMENTS

		#ACTION FOR ADDING CUSTOM ELEMENT
		add_action('vc_before_init', array($this, 'htheme_banner_element') ); // ~ BANNER
		add_action('vc_before_init', array($this, 'htheme_launch_element') ); // ~ LAUNCH PADS
		add_action('vc_before_init', array($this, 'htheme_title_element') ); // ~ TITLE
		add_action('vc_before_init', array($this, 'htheme_blog_element') ); // ~ BLOG
		add_action('vc_before_init', array($this, 'htheme_blog_carousel_element') ); // ~ BLOG CAROUSEL
		add_action('vc_before_init', array($this, 'htheme_instagram_element') ); // ~ INSTAGRAM
		add_action('vc_before_init', array($this, 'htheme_imgcarousel_element') ); // ~ IMG CAROUSEL
		add_action('vc_before_init', array($this, 'htheme_contact_form_element')); // ~ CONTACT FORM ELEMENT
		add_action('vc_before_init', array($this, 'htheme_map_element')); // ~ MAP ELEMENT
		add_action('vc_before_init', array($this, 'htheme_line_element')); // ~ HORIZONTAL LINE ELEMENT

		#IF POST TYPES ARE AVAILABLE
		if(is_plugin_active( 'hutility/hutility.php' )){
			add_action('vc_before_init', array($this, 'htheme_people_element')); // ~ PEOPLE/MEMBERS ELEMENT
			add_action('vc_before_init', array($this, 'htheme_signup_form_element')); // ~ NEWSLETTER SIGNUP FORM ELEMENT
			add_action('vc_before_init', array($this, 'htheme_lookbooks')); // ~ LOOKBOOKS
			add_action('vc_before_init', array($this, 'htheme_testimonial_element') ); // ~ TESTIMONIAL
		}

		#ADD PARAMS
		add_action('vc_before_init', array($this, 'htheme_add_params')); // ~ HORIZONTAL LINE ELEMENT

		#REMOVE PARAMS
		add_action('vc_before_init', array($this, 'htheme_remove_params')); // ~ HORIZONTAL LINE ELEMENT

		#IF WOOCOMMERCE CLASS EXIST - ADD WOO VISUAL COMPOSER ELEMENTS
		if ( class_exists( 'WooCommerce' ) ){
			add_action('vc_before_init', array($this, 'htheme_woolist_element')); // ~ WOO LIST
			add_action('vc_before_init', array($this, 'htheme_woocategory_element')); // ~ WOO CATEGORY
			add_action('vc_before_init', array($this, 'htheme_woocol_element')); // ~ WOO COL
			add_action('vc_before_init', array($this, 'htheme_look_element')); // ~ GET THE LOOK
			add_action('vc_before_init', array($this, 'htheme_promo_element')); // ~ PROMO
			add_action('vc_before_init', array($this, 'htheme_top_ten')); // ~ TOP TEN
		}

		// ~ TEMPLATES

		#ACTION FOR ADDING A TEMPLATE
		add_filter( 'vc_load_default_templates', array($this, 'htheme_my_custom_template_at_first_position') );

	}

	/************************************************
	 * VISUAL COMPOSER NEW PARAMS
	 ************************************************/

	#ADD PARAMS
	public function htheme_add_params(){

		#VC ROW PARAMS
		vc_add_param("vc_row", array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Padding (Row)",
			'category' => esc_html__( 'Content', 'js_composer' ),
			"param_name" => "row_padding",
			"value" => array(
				"None" => "none",
				"Top and Bottom" => "row_padding_top_bottom",
				"Top Only" => "row_padding_top",
				"Bottom Only" => "row_padding_bottom",
			),
			'description' => esc_html__( 'Select the row padding (Top, Bottom)', 'js_composer' ),
		));

		vc_add_param("vc_row", array(
			"type" => "dropdown",
			"class" => "",
			"heading" => "Margin (Row)",
			'category' => esc_html__( 'Content', 'js_composer' ),
			"param_name" => "row_margin",
			"value" => array(
				"Top and Bottom" => "row_margin_top_bottom",
				"Top Only" => "row_margin_top",
				"Bottom Only" => "row_margin_bottom",
				"None" => "none",
			),
			'description' => esc_html__( 'Select the row margin (Top, Bottom)', 'js_composer' ),
		));

	}

	#REMOVE PARAMS
	public function htheme_remove_params(){

		#VC ROW PARAMS REMOVE
		vc_remove_param( "vc_row", "gap" );
		vc_remove_param( "vc_row", "full_height" );
		vc_remove_param( "vc_row", "equal_height" );
		vc_remove_param( "vc_row", "content_placement" );
		vc_remove_param( "vc_row", "columns_placement" );
		vc_remove_param( "vc_row", "video_bg" );
		vc_remove_param( "vc_row", "parallax" );
		vc_remove_param( "vc_row", "el_id" );
		//vc_remove_param( "vc_row", "el_class" );
		vc_remove_param( "vc_row", "video_bg_url" );
		vc_remove_param( "vc_row", "video_bg_parallax" );
		vc_remove_param( "vc_row", "gallery_widget_attached_images_ids" );
		vc_remove_param( "vc_row", "parallax_speed_bg" );
		vc_remove_param( "vc_row", "parallax_speed_video" );
		vc_remove_param( "vc_row", "parallax_image" );

	}

	/************************************************
	 * CUSTOM ROW LAYOUT
	 ************************************************/


	/************************************************
	 * VISUAL COMPOSER ELEMENTS
	 ************************************************/

	#CONTACT SIGNUP ELEMENT
	public function htheme_line_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Line Divider", "js_composer" ),
				"base" => "htheme_line_slug",
				"class" => "",
				'icon' => 'htheme_line_icon',
				"category" => esc_html__( "Content", "js_composer"),
				'description' => esc_html__( "Horizontal line divider.", "js_composer" ),
				"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Layout", "js_composer" ),
						"param_name" => "htheme_line_layout",
						"value" =>  array(
							"Full width" => "full",
							"Contained" => "contained",
						),
						'std' => '',
						"description" => esc_html__( "Choose the layout for your content line separator.", "js_composer" )
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Line Color", "js_composer" ),
						"param_name" => "htheme_line_color",
						"value" => __( "#EEE", "js_composer" ),
						"description" => esc_html__( "Set the color for your content line separator.", "js_composer" )
					),
				)
			)
		);

	}

	#SIGNUP FORM ~ GET SHORTCODE DATA
	function htheme_line_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_line($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#MAP ELEMENT
	public function htheme_map_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Google Map", "js_composer" ),
				"base" => "htheme_map_slug",
				"class" => "",
				'icon' => 'htheme_map_icon',
				"category" => esc_html__( "Contact", "js_composer"),
				'description' => esc_html__( "Add map and custom marker.", "js_composer" ),
				"params" => array(
					array(
						"type" => "checkbox",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Enable map zoom", "js_composer" ),
						"param_name" => "htheme_map_enable_zoom",
						"value" => __( "true", "js_composer" ),
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Map center latitude", "js_composer" ),
						"param_name" => "htheme_map_center_lat",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Latitude.", "js_composer" )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Map center Longitude", "js_composer" ),
						"param_name" => "htheme_map_center_long",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Longitude.", "js_composer" )
					),
					array(
						"type" => "checkbox",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Use images for markers", "js_composer" ),
						"param_name" => "htheme_map_enable_images",
						"value" => esc_html__( "true", "js_composer" ),
					),
					array(
						"type" => "attach_image",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Marker image", "js_composer" ),
						"param_name" => "htheme_map_marker_image",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Add a marker image.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Map zoom level", "js_composer" ),
						"param_name" => "htheme_map_zoom",
						"value" =>  array(
							"Zoom Level 1" => "1",
							"Zoom Level 2" => "2",
							"Zoom Level 3" => "3",
							"Zoom Level 4" => "4",
							"Zoom Level 5" => "5",
							"Zoom Level 6" => "6",
							"Zoom Level 7" => "7",
							"Zoom Level 8" => "8",
							"Zoom Level 9" => "9",
							"Zoom Level 10" => "10",
							"Zoom Level 11" => "11",
							"Zoom Level 12" => "12",
							"Zoom Level 13" => "13",
						),
						'std' => "10",
						"description" => esc_html__( "Choose the zoom level for your map.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Map style", "js_composer" ),
						"param_name" => "htheme_map_styles",
						"value" =>  array(
							"Original" => "original",
							"Shades of Grey" => "ShadesOfGrey",
							"Cool Grey" => "CoolGrey",
							"Pastel Tones" => "PastelTones",
							"Mostly Grayscale" => "MostlyGrayscale",
							"Apple Maps-esque" => "AppleMapsEsque",
						),
						'std' => '',
						"description" => esc_html__( "Choose the layout for your banner area.", "js_composer" )
					),
					array(
						"type" => "param_group",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Markers", "js_composer" ),
						"param_name" => "htheme_map_markers",
						"value" => "",
						'params' => array(
							array(
								"type" => "checkbox",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Enable marker", "js_composer" ),
								"param_name" => "htheme_map_enable_marker",
								"value" => __( "false", "js_composer" ),
							),
							array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Latitude", "js_composer" ),
								"param_name" => "htheme_map_marker_lat",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Latitude.", "js_composer" )
							),
							array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Longitude", "js_composer" ),
								"param_name" => "htheme_map_marker_long",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Longitude.", "js_composer" )
							),
							array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Marker info heading", "js_composer" ),
								"param_name" => "htheme_map_marker_heading",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Set the marker info heading.", "js_composer" )
							),
							array(
								"type" => "textarea",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Marker info window", "js_composer" ),
								"param_name" => "htheme_map_marker_info",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Add the marker info here.", "js_composer" )
							),
						),
					),
				)
			)
		);

	}

	#MAP ~ GET SHORTCODE DATA
	function htheme_map_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_map($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#CONTACT SIGNUP ELEMENT
	public function htheme_signup_form_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Newsletter Signup", "js_composer" ),
				"base" => "htheme_signup_slug",
				"class" => "",
				'icon' => 'htheme_signup_icon',
				"category" => esc_html__( "Contact", "js_composer"),
				'description' => esc_html__( "Save email addresses to db.", "js_composer" ),
				"params" => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Signup title", "js_composer" ),
						"param_name" => "htheme_signup_title",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set the signup title.", "js_composer" )
					),
					array(
						"type" => "textarea",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Signup sub title", "js_composer" ),
						"param_name" => "htheme_signup_excerpt",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set the sub title.", "js_composer" )
					),
				)
			)
		);

	}

	#SIGNUP FORM ~ GET SHORTCODE DATA
	function htheme_signup_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_signup_form($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#CONTACT FORM ELEMENT
	public function htheme_contact_form_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Contact Form", "js_composer" ),
				"base" => "htheme_contact_slug",
				"class" => "",
				'icon' => 'htheme_contact_icon',
				"category" => esc_html__( "Contact", "js_composer"),
				'description' => esc_html__( "Fill in and send", "js_composer" ),
				"params" => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Email subject", "js_composer" ),
						"param_name" => "htheme_contact_subject",
						"value" => esc_html__( "Contact Enquiry", "js_composer" ),
						"description" => esc_html__( "Set the subject line for admin response email.", "js_composer" )
					),
				)
			)
		);

	}

	#CONTACT FORM ~ GET SHORTCODE DATA
	function htheme_contact_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_contact_form($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#BANNER ELEMENT
	public function htheme_banner_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Banner Ad", "js_composer" ),
				"base" => "htheme_banner_slug",
				"class" => "",
				'icon' => 'htheme_banner_icon',
				"category" => esc_html__( "Promotion", "js_composer"),
				'description' => esc_html__( "Display a banner ad.", "js_composer" ),
				"params" => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Banner Title", "js_composer" ),
						"param_name" => "htheme_banner_title",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Title for banner.", "js_composer" )
					),
					array(
						"type" => "textarea",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Banner Excerpt", "js_composer" ),
						"param_name" => "htheme_banner_excerpt",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Excerpt for banner.", "js_composer" )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Banner Height", "js_composer" ),
						"param_name" => "htheme_banner_height",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set the height for banner.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Banner Layout", "js_composer" ),
						"param_name" => "htheme_banner_layout",
						"value" =>  array(
							'Contained'   => 'contained_row',
							'Full row'   => 'full_row',
						),
						'std' => '',
						"description" => esc_html__( "Choose the layout for your banner.", "js_composer" ),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Content Position", "js_composer" ),
						"param_name" => "htheme_banner_content_position",
						"value" => array(
							"Left" => "left",
							"Right" => "right",
							"Center" => "center",
						),
						'std' => '',
						"description" => esc_html__( "Set the position of the content.", "js_composer" ),
					),
					array(
						"type" => "checkbox",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Banner Button", "js_composer" ),
						"param_name" => "htheme_banner_button",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Enable banner button (show/hide).", "js_composer" )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Button Text", "js_composer" ),
						"param_name" => "htheme_banner_button_text",
						"value" => esc_html__( "View Now", "js_composer" ),
						"description" => esc_html__( "Set the text for you banner button.", "js_composer" ),
						"dependency" => array('element' => "htheme_banner_button", 'value' => array('true')),
					),
					array(
						"type" => "attach_image",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Background image", "js_composer" ),
						"param_name" => "htheme_banner_image",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Background image for banner.", "js_composer" )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Banner URL", "js_composer" ),
						"param_name" => "htheme_banner_url",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Banner URL.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Banner URL Target", "js_composer" ),
						"param_name" => "htheme_banner_url_target",
						"value" => array(
							"New Window" => "_blank",
							"Same Window" => "_self",
						),
						'std' => '',
						"description" => esc_html__( "URL target.", "js_composer" )
					),
				)
			)
		);

	}

	#BANNER ~ GET SHORTCODE DATA
	function htheme_banner_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_content_banner($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#LAUNCH PADS ELEMENT
	public function htheme_launch_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Banner Launchpads", "js_composer" ),
				"base" => "htheme_launch_slug",
				"class" => "",
				'icon' => 'htheme_launch_icon',
				"category" => esc_html__( "Promotion", "js_composer"),
				'description' => esc_html__( "Small banner ads.", "js_composer" ),
				"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Content alignment", "js_composer" ),
						"param_name" => "htheme_launch_align",
						"value" => array(
							"Center" => "center",
							"Right" => "right",
							"Left" => "left",
						),
						'std' => '',
						"description" => esc_html__( "Set the alignment of you text.", "js_composer" )
					),
					array(
						"type" => "param_group",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "List of launch pads", "js_composer" ),
						"param_name" => "htheme_pad_launch",
						"value" => "",
						'params' => array(
							array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Launch pad title", "js_composer" ),
								"param_name" => "htheme_pad_title",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Set the title for your launch pad.", "js_composer" )
							),
							array(
								"type" => "textarea",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Launch pad excerpt", "js_composer" ),
								"param_name" => "htheme_pad_excerpt",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Add additional content for the launch pad.", "js_composer" )
							),
							array(
								"type" => "attach_image",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Background image", "js_composer" ),
								"param_name" => "htheme_pad_image",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Background image for the launch pad.", "js_composer" )
							),
							array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Launch pad URL", "js_composer" ),
								"param_name" => "htheme_pad_url",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Set the URL for the launch pad.", "js_composer" )
							),
						),
					),
				)
			)
		);

	}

	#LAUNCH PADS ~ GET SHORTCODE DATA
	function htheme_launch_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_content_launch($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#WOOLIST ELEMENT
	public function htheme_woolist_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Products", "js_composer" ),
				"base" => "htheme_woolist_slug",
				"class" => "",
				'icon' => 'htheme_woolist_icon',
				"category" => esc_html__( "WooCommerce", "js_composer"),
				'description' => esc_html__( "Add items from WooCommerce.", "js_composer" ),
				"params" => array(
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Categories', 'js_composer' ),
						'param_name' => 'htheme_woolist_ids',
						'settings' => array(
							'multiple' => true,
							'sortable' => true,
							'values' => $this->htheme_get_product_category_autocomplete(),
						),
						'save_always' => true,
						'description' => esc_html__( 'List of product categories', 'js_composer' ),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Product Sorting", "js_composer" ),
						"param_name" => "htheme_woolist_sorting",
						"value" =>  array(
							"Sort by title" => "title",
							"Sort by date" => "date",
							"Sort by price high to low" => "high_low",
							"Sort by price low to high" => "low_high",
						),
						'std' => '',
						"description" => esc_html__( "Choose how you want to sort your products.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Layout", "js_composer" ),
						"param_name" => "htheme_woolist_layout",
						"value" => array(
							"Full width Carousel" => "full_width_caro",
							"Contained Carousel" => "contained_caro",
							"Contained Multiple Row with Loader" => "contained_multi_caro",
						),
						'std' => '',
						"description" => esc_html__( "Choose the layout for your product list.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Category alignment", "js_composer" ),
						"param_name" => "htheme_category_align",
						"value" => array(
							"Align Left" => "left",
							"Align Right" => "right",
							"Align Center" => "center",
						),
						'std' => '',
						"description" => esc_html__( "Set the alignment for your categories.", "js_composer" ),
						"dependency" => Array('element' => "htheme_woolist_layout", 'value' => array('contained_multi_caro')),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Product rows", "js_composer" ),
						"param_name" => "htheme_product_rows",
						"value" => array(
							"1 Product Row" => 1,
							"2 Product Rows" => 2,
							"3 Product Rows" => 3,
							"4 Product Rows" => 4,
							"5 Product Rows" => 5,
						),
						'std' => '',
						"description" => esc_html__( "Set amount of product rows to display on initial load.", "js_composer" ),
						"dependency" => array('element' => "htheme_woolist_layout", 'value' => array('contained_multi_caro')),
					),
				)
			)
		);

	}

	#WOOLIST ~ GET SHORTCODE DATA
	function htheme_woolist_shortcode( $atts ) {

		#IF WOOCOMMERCE CLASS EXIST - ADD WOO VISUAL COMPOSER ELEMENTS
		if ( class_exists( 'WooCommerce' ) ){
			#SETUP WOO CONTENT CLASS
			$htheme_data = $this->htheme_woo_content->htheme_get_woo_product_list($atts, false);

			#RETURN DATA/HTML
			return $htheme_data;
		} else {
			return 'WooCommerce required!';
		}

	}

	#WOOLIST ELEMENT
	public function htheme_woocategory_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Product Categories", "js_composer" ),
				"base" => "htheme_woocategory_slug",
				"class" => "",
				'icon' => 'htheme_woocategory_icon',
				"category" => esc_html__( "WooCommerce", "js_composer"),
				'description' => esc_html__( "Display Woo categories.", "js_composer" ),
				"params" => array(
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Categories', 'js_composer' ),
						'param_name' => 'htheme_woocategory_ids',
						'settings' => array(
							'multiple' => true,
							'sortable' => true,
							'values' => $this->htheme_get_product_category_autocomplete(),
						),
						'save_always' => true,
						'description' => esc_html__( 'List of product categories', 'js_composer' ),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Layout", "js_composer" ),
						"param_name" => "htheme_woocategory_layout",
						"value" => array(
							"Full width Carousel" => "full_width_caro",
							"Contained Carousel" => "contained_row"
						),
						'std' => '',
						"description" => esc_html__( "Set category layout.", "js_composer" )
					),
				)
			)
		);

	}

	#WOOLIST ~ GET SHORTCODE DATA
	function htheme_woocategory_shortcode( $atts ) {

		#IF WOOCOMMERCE CLASS EXIST - ADD WOO VISUAL COMPOSER ELEMENTS
		if ( class_exists( 'WooCommerce' ) ){
			#SETUP WOO CONTENT CLASS
			$htheme_data = $this->htheme_woo_content->htheme_get_woo_product_category($atts);

			#RETURN DATA/HTML
			return $htheme_data;
		} else {
			return 'WooCommerce required!';
		}

	}

	#PROMO LIST ELEMENT
	public function htheme_promo_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Promo Slider", "js_composer" ),
				"base" => "htheme_promo_slug",
				"class" => "",
				'icon' => 'htheme_promo_icon',
				"category" => esc_html__( "WooCommerce", "js_composer"),
				'description' => esc_html__( "Woo product slider.", "js_composer" ),
				"params" => array(
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'List of products on promotion', 'js_composer' ),
						'param_name' => 'htheme_promo_ids',
						'settings' => array(
							'multiple' => true,
							'sortable' => true,
							'values' => $this->htheme_get_product_autocomplete(),
						),
						'save_always' => true,
						'description' => esc_html__( 'Add multiple products to create promotional slider.', 'js_composer' ),
					),
				)
			)
		);

	}

	#PROMO LIST ~ GET SHORTCODE DATA
	function htheme_promo_shortcode( $atts ) {

		#IF WOOCOMMERCE CLASS EXIST - ADD WOO VISUAL COMPOSER ELEMENTS
		if ( class_exists( 'WooCommerce' ) ){
			#SETUP WOO CONTENT CLASS
			$htheme_data = $this->htheme_woo_content->htheme_get_woo_promo($atts);

			#RETURN DATA/HTML
			return $htheme_data;
		} else {
			return 'WooCommerce required!';
		}

	}

	#PEOPLE ELEMENT
	public function htheme_people_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Our People/Members", "js_composer" ),
				"base" => "htheme_people_slug",
				"class" => "",
				'icon' => 'htheme_people_icon',
				"category" => esc_html__( "WooCommerce", "js_composer"),
				'description' => esc_html__( "Display members.", "js_composer" ),
				"params" => array(
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'List of members', 'js_composer' ),
						'param_name' => 'htheme_people_ids',
						'settings' => array(
							'multiple' => true,
							'sortable' => true,
							'values' => $this->htheme_get_post_people_autocomplete(),
						),
						'save_always' => true,
						'description' => esc_html__( 'Add multiple members.', 'js_composer' ),
					),
				)
			)
		);

	}

	#PEOPLE LIST ~ GET SHORTCODE DATA
	function htheme_people_shortcode( $atts ) {

		#SETUP WOO CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_people($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	/////////////////////
	#PROMO LIST ELEMENT
	public function htheme_top_ten(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Product Promotions", "js_composer" ),
				"base" => "htheme_topten_slug",
				"class" => "",
				'icon' => 'htheme_topten_icon',
				"category" => esc_html__( "WooCommerce", "js_composer"),
				'description' => esc_html__( "Add a promo slider to your content.", "js_composer" ),
				"params" => array(
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'List of products', 'js_composer' ),
						'param_name' => 'htheme_topten_ids',
						'settings' => array(
							'multiple' => true,
							'sortable' => true,
							'values' => $this->htheme_get_product_autocomplete(),
						),
						'save_always' => true,
						'description' => esc_html__( 'Add a few products to create a top ten layout.', 'js_composer' ),
					),
				)
			)
		);

	}

	#PROMO LIST ~ GET SHORTCODE DATA
	function htheme_top_ten_shortcode( $atts ) {

		#IF WOOCOMMERCE CLASS EXIST - ADD WOO VISUAL COMPOSER ELEMENTS
		if ( class_exists( 'WooCommerce' ) ){
			#SETUP WOO CONTENT CLASS
			$htheme_data = $this->htheme_woo_content->htheme_get_topten_promo($atts);

			#RETURN DATA/HTML
			return $htheme_data;
		} else {
			return 'WooCommerce required!';
		}

	}
	/////////////////////

	#THE LOOK LIST ELEMENT
	public function htheme_look_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Get The Look", "js_composer" ),
				"base" => "htheme_look_slug",
				"class" => "",
				'icon' => 'htheme_look_icon',
				"category" => esc_html__( "WooCommerce", "js_composer"),
				'description' => esc_html__( "Grouped products in one slider.", "js_composer" ),
				"params" => array(
					array(
						"type" => "param_group",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Get the look sets", "js_composer" ),
						"param_name" => "htheme_look_looks",
						"value" => "",
						'params' => array(
							array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Get the look title", "js_composer" ),
								"param_name" => "htheme_look_title",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Set the title for the look.", "js_composer" )
							),
							array(
								'type' => 'autocomplete',
								'heading' => esc_html__( 'Get the look products', 'js_composer' ),
								'param_name' => 'htheme_look_products',
								'settings' => array(
									'multiple' => true,
									'sortable' => true,
									'values' => $this->htheme_get_product_autocomplete(),
								),
								'save_always' => true,
								'description' => esc_html__( 'A list of all the products in the look.', 'js_composer' ),
							),
							array(
								"type" => "attach_image",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Background image 1", "js_composer" ),
								"param_name" => "htheme_look_image_1",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Background image one.", "js_composer" )
							),
							array(
								"type" => "attach_image",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Background image 2", "js_composer" ),
								"param_name" => "htheme_look_image_2",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Background image two.", "js_composer" )
							),
						),
						"description" => esc_html__( "Add a look.", "js_composer" )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Button Text", "js_composer" ),
						"param_name" => "htheme_look_button_text",
						"value" => esc_html__( "View Now", "js_composer" ),
						"description" => esc_html__( "Set look view now button text.", "js_composer" )
					),
				)
			)
		);

	}

	#THE LOOK LIST ~ GET SHORTCODE DATA
	function htheme_look_shortcode( $atts ) {

		#IF WOOCOMMERCE CLASS EXIST - ADD WOO VISUAL COMPOSER ELEMENTS
		if ( class_exists( 'WooCommerce' ) ){
			#SETUP WOO CONTENT CLASS
			$htheme_data = $this->htheme_woo_content->htheme_get_woo_look($atts);

			#RETURN DATA/HTML
			return $htheme_data;
		} else {
			return 'WooCommerce required!';
		}

	}

	#WOOCOL LIST ELEMENT
	public function htheme_woocol_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Product Mini Lists", "js_composer" ),
				"base" => "htheme_woocol_slug",
				"class" => "",
				'icon' => 'htheme_woocol_icon',
				"category" => esc_html__( "WooCommerce", "js_composer"),
				'description' => esc_html__( "Add columns to display Woo products.", "js_composer" ),
				"params" => array(
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Total products to display per column", "js_composer" ),
						"param_name" => "htheme_woocol_display",
						"value" => array(
							"Maximum 2 Products" => "2",
							"Maximum 3 Products" => "3",
							"Maximum 4 Products" => "4",
							"Maximum 5 Products" => "5",
							"Maximum 6 Products" => "6",
							"Maximum 7 Products" => "7",
						),
						'std' => '',
						"description" => esc_html__( "This will define the maximum amount of products to display per column.", "js_composer" )
					),
					array(
						"type" => "param_group",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Product category columns", "js_composer" ),
						"param_name" => "htheme_woocol_cols",
						"value" => "",
						'params' => array(
							array(
								"type" => "textfield",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Column Title", "js_composer" ),
								"param_name" => "htheme_woocol_title",
								"value" => __( "", "js_composer" ),
								"description" => esc_html__( "Set column title.", "js_composer" )
							),
							array(
								"type" => "dropdown",
								"holder" => "div",
								"class" => "htheme_element_class",
								"heading" => esc_html__( "Display type", "js_composer" ),
								"param_name" => "htheme_woocol_display_type",
								"value" => array(
									"On Sale" => "sale",
									"Best Rated" => "rated",
									"Best Sales" => "top_sales",
									"Category" => "category",
								),
								'std' => '',
								"description" => esc_html__( "Set data to display in column.", "js_composer" )
							),
							array(
								'type' => 'autocomplete',
								'heading' => esc_html__( 'Product category', 'js_composer' ),
								'param_name' => 'htheme_woocol_category',
								'settings' => array(
									'multiple' => false,
									'values' => $this->htheme_get_product_category_autocomplete(),
								),
								'save_always' => true,
								'description' => esc_html__( 'List of post categories', 'js_composer' ),
								"dependency" => Array('element' => "htheme_woocol_display_type", 'value' => array('category'))
							),
						),
						"description" => esc_html__( "Add product category column.", "js_composer" )
					),
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Background Color", "js_composer" ),
						"param_name" => "htheme_woocol_color",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set the background color for your column container.", "js_composer" )
					),
				)
			)
		);

	}

	#WOOCOL LIST ~ GET SHORTCODE DATA
	function htheme_woocol_shortcode( $atts ) {

		#IF WOOCOMMERCE CLASS EXIST - ADD WOO VISUAL COMPOSER ELEMENTS
		if ( class_exists( 'WooCommerce' ) ){
			#SETUP WOO CONTENT CLASS
			$htheme_data = $this->htheme_woo_content->htheme_get_woo_product_col($atts);

			#RETURN DATA/HTML
			return $htheme_data;
		} else {
			return 'WooCommerce required!';
		}

	}

	#TITLE ELEMENT
	public function htheme_title_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Centered Heading", "js_composer" ),
				"base" => "htheme_title_slug",
				"class" => "",
				'icon' => 'htheme_title_icon',
				"category" => esc_html__( "Content", "js_composer"),
				'description' => esc_html__( "Section headings.", "js_composer" ),
				"params" => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Title", "js_composer" ),
						"param_name" => "htheme_title_title",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set the title.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Title/Excerpt divider", "js_composer" ),
						"param_name" => "htheme_title_devider",
						"value" => array(
							"None" => "none",
							"ZigZag" => "zigzag",
							"Hearts" => "hearts",
							"Diagonal" => "diagonal",
							"Line" => "line",
							"Plus" => "plus",
							"Circles" => "circles",
							"Spiral" => "spiral",
							"X" => "x",
						),
						'std' => '',
						"description" => esc_html__( "Set the divider for your title element.", "js_composer" )
					),
					/*array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Divider Color", "js_composer" ),
						"param_name" => "htheme_title_devider_color",
						"value" => __( "#EEEEEE", "js_composer" ),
						"description" => esc_html__( "Set the color for your title and excerpt divider.", "js_composer" ),
						"dependency" => Array('element' => "htheme_title_devider", 'value' => array('zigzag', 'hearts', 'diagonal', 'line', 'plus', 'circles', 'spiral', 'x')),
					),*/
					array(
						"type" => "textarea",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Excerpt", "js_composer" ),
						"param_name" => "htheme_title_excerpt",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set sub title.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Title Layout", "js_composer" ),
						"param_name" => "htheme_title_layout",
						"value" => array(
							"Lines, Title with Excerpt" => "side_by_side",
							"Title with Excerpt" => "default",
							"Lines Above and Below with Title" => "top_bottom",
						),
						'std' => '',
						"description" => esc_html__( "Set the title layout.", "js_composer" )
					),
				)
			)
		);

	}

	#TITLE ~ GET SHORTCODE DATA
	function htheme_title_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_titles($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#BLOG ELEMENT
	public function htheme_blog_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Blog Posts", "js_composer" ),
				"base" => "htheme_blog_slug",
				"class" => "",
				'icon' => 'htheme_blog_icon',
				"category" => esc_html__( "Content", "js_composer"),
				'description' => esc_html__( "2 latest blog posts only.", "js_composer" ),
				"params" => array(
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Category', 'js_composer' ),
						'param_name' => 'htheme_blog_category',
						'settings' => array(
							'multiple' => false,
							'values' => $this->htheme_get_post_category_autocomplete(),
						),
						'save_always' => true,
						'description' => esc_html__( 'Set category to display within the blog split.', 'js_composer' ),
					)
				)
			)
		);

	}

	#BLOG ~ GET SHORTCODE DATA
	function htheme_blog_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_content_blog_split($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#BLOG ELEMENT
	public function htheme_blog_carousel_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Blog Posts Carousel", "js_composer" ),
				"base" => "htheme_blog_carousel_slug",
				"class" => "",
				'icon' => 'htheme_blog_carousel_icon',
				"category" => esc_html__( "Content", "js_composer"),
				'description' => esc_html__( "Multiple blog posts in a slider.", "js_composer" ),
				"params" => array(
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Category', 'js_composer' ),
						'param_name' => 'htheme_blog_carousel_category',
						'settings' => array(
							'multiple' => true,
							'values' => $this->htheme_get_post_category_autocomplete(),
						),
						'save_always' => true,
						'description' => esc_html__( 'List of post categories', 'js_composer' ),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Layout", "js_composer" ),
						"param_name" => "htheme_blog_carousel_layout",
						"value" => array(
							'Full row carousel'   => 'full_row',
							'Contained carousel'   => 'contained_row'
						),
						'std' => '',
						"description" => esc_html__( "Choose the layout for your blog post carousel.", "js_composer" ),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Desktop items", "js_composer" ),
						"param_name" => "htheme_carousel_desktop",
						"value" => array(
							'1 Item'   => '1',
							'2 Items'   => '2',
							'3 Items'   => '3',
							'4 Items'   => '4',
							'5 Items'   => '5',
							'6 Items'   => '6',
							'7 Items'   => '7',
							'8 Items'   => '8',
							'9 Items'   => '9',
							'10 Items'   => '10'
						),
						'std' => '4',
						"dependency" => Array('element' => "htheme_blog_carousel_layout", 'value' => array('contained_row'))
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Tablet items", "js_composer" ),
						"param_name" => "htheme_carousel_tablet",
						"value" => array(
							'1 Item'   => '1',
							'2 Items'   => '2',
							'3 Items'   => '3',
							'4 Items'   => '4',
							'5 Items'   => '5'
						),
						'std' => '3',
						"dependency" => Array('element' => "htheme_blog_carousel_layout", 'value' => array('contained_row'))
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Mobile items", "js_composer" ),
						"param_name" => "htheme_carousel_mobile",
						"value" => array(
							'1 Item'   => '1',
							'2 Items'   => '2',
							'3 Items'   => '3',
							'4 Items'   => '4'
						),
						'std' => '1',
						"dependency" => Array('element' => "htheme_blog_carousel_layout", 'value' => array('contained_row'))
					),
				)
			)
		);

	}

	#BLOG ~ GET SHORTCODE DATA
	function htheme_blog_carousel_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_content_blog_carousel($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#TESTIMONIAL LIST ELEMENT
	public function htheme_testimonial_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Testimonial Slider", "js_composer" ),
				"base" => "htheme_testimonial_slug",
				"class" => "",
				'icon' => 'htheme_testimonial_icon',
				"category" => esc_html__( "Content", "js_composer"),
				'description' => esc_html__( "Testimonials from customers.", "js_composer" ),
				"params" => array(
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'List of members', 'js_composer' ),
						'param_name' => 'htheme_testimonial_ids',
						'settings' => array(
							'multiple' => true,
							'sortable' => true,
							'values' => $this->htheme_get_testimonials_autocomplete(),
						),
						'save_always' => true,
						'description' => esc_html__( 'Add multiple testimonials.', 'js_composer' ),
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Testimonial row height", "js_composer" ),
						"param_name" => "htheme_testimonial_height",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set the height for your testimonial row", "js_composer" )
					),
					array(
						"type" => "attach_image",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Background image", "js_composer" ),
						"param_name" => "htheme_testimonial_bg",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set the background image for your testimonial row.", "js_composer" )
					),
					array(
						"type" => "checkbox",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Show Title", "js_composer" ),
						"param_name" => "htheme_testimonial_title",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Enable the title for testimonials (show/hide).", "js_composer" )
					),
					array(
						"type" => "checkbox",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Show Rating", "js_composer" ),
						"param_name" => "htheme_testimonial_rating",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Enable the user rating for testimonials (show/hide).", "js_composer" )
					),
					array(
						"type" => "checkbox",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Show Excerpt", "js_composer" ),
						"param_name" => "htheme_testimonial_excerpt",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Enable the user excerpt for testimonials (show/hide).", "js_composer" )
					),
				)
			)
		);

	}

	#TESTIMONIAL LIST ~ GET SHORTCODE DATA
	function htheme_testimonial_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_testimonials($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#INSTAGRAM LIST ELEMENT
	public function htheme_instagram_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Instagram Feed", "js_composer" ),
				"base" => "htheme_instagram_slug",
				"class" => "",
				'icon' => 'htheme_instagram_icon',
				"category" => esc_html__( "Content", "js_composer"),
				'description' => esc_html__( "Your latest live feed.", "js_composer" ),
				"params" => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Title", "js_composer" ),
						"param_name" => "htheme_instagram_title",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Title for instagram overlay box.", "js_composer" )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "User ID", "js_composer" ),
						"param_name" => "htheme_instagram_uid",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set the user ID for you feed.", "js_composer" )
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Access Token", "js_composer" ),
						"param_name" => "htheme_instagram_token",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set the access token for your feed.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Instagram Layout", "js_composer" ),
						"param_name" => "htheme_instagram_layout",
						"value" =>  array(
							"Default" => "default",
							"Mosaic Layout" => "mosaic",
						),
						'std' => "default",
						"description" => esc_html__( "Set the layout for your Instagram feed.", "js_composer" )
					),
					array(
						"type" => "attach_image",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Background image", "js_composer" ),
						"param_name" => "htheme_instagram_bg",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Set the background image for your mosaic instagram content box.", "js_composer" ),
						"dependency" => Array('element' => "htheme_instagram_layout", 'value' => array('mosaic'))
					),
				)
			)
		);

	}

	#INSTAGRAM LIST ~ GET SHORTCODE DATA
	function htheme_instagram_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_instagram($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#IMAGE CAROUSEL LIST ELEMENT
	public function htheme_imgcarousel_element(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Basic Image Carousel", "js_composer" ),
				"base" => "htheme_imgcarousel_slug",
				"class" => "",
				'icon' => 'htheme_imgcarousel_icon',
				"category" => esc_html__( "WooCommerce", "js_composer"),
				'description' => esc_html__( "Add an image carousel to your site.", "js_composer" ),
				"params" => array(
					array(
						"type" => "attach_images",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Images", "js_composer" ),
						"param_name" => "htheme_imgcarousel_images",
						"value" => __( "", "js_composer" ),
						"description" => esc_html__( "Add multiple images for you image carousel.", "js_composer" )
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Image sizing", "js_composer" ),
						"param_name" => "htheme_image_carousel_size",
						"value" => array(
							'Contain' => 'contain',
							'Cover' => 'cover',
							'Auto' => 'auto'
						),
						'std' => '',
						"description" => esc_html__( "Choose the image sizing.", "js_composer" ),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Layout", "js_composer" ),
						"param_name" => "htheme_image_carousel_layout",
						"value" => array(
							'Full row carousel'   => 'full_row',
							'Contained carousel'   => 'contained_row'
						),
						'std' => '',
						"description" => esc_html__( "Choose the layout for your image carousel.", "js_composer" ),
					),
					array(
						"type" => "dropdown",
						"holder" => "div",
						"class" => "htheme_element_class",
						"heading" => esc_html__( "Carousel height", "js_composer" ),
						"param_name" => "htheme_image_carousel_height",
						"value" => array(
							'100px'   => 100,
							'200px'   => 200,
							'300px'   => 300,
							'400px'   => 400,
							'500px'   => 500,
						),
						'std' => '',
						"description" => esc_html__( "Set the height for your image carousel.", "js_composer" ),
					),
				)
			)
		);

	}

	#IMAGE CAROUSEL ~ GET SHORTCODE DATA
	function htheme_imgcarousel_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_image_carousel($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	#THE LOOK LIST ELEMENT
	public function htheme_lookbooks(){

		//SETUP VC MAP
		vc_map(
			array(
				"name" => esc_html__( "Lookbooks Slider", "js_composer" ),
				"base" => "htheme_lookbooks_slug",
				"class" => "",
				'icon' => 'htheme_lookbooks_icon',
				"category" => esc_html__( "Content", "js_composer"),
				'description' => esc_html__( "Multiple lookbooks in a slider.", "js_composer" ),
				"params" => array(
					array(
						'type' => 'autocomplete',
						'heading' => esc_html__( 'Lookbook collection', 'js_composer' ),
						'param_name' => 'htheme_lookbooks',
						'settings' => array(
							'multiple' => true,
							'sortable' => true,
							'values' => $this->htheme_get_post_lookbook_autocomplete(),
						),
						'save_always' => true,
						'description' => esc_html__( 'List of Lookbooks', 'js_composer' ),
					),
				)
			)
		);

	}

	#THE LOOK LIST ~ GET SHORTCODE DATA
	function htheme_lookbooks_shortcode( $atts ) {

		#SETUP CONTENT CLASS
		$htheme_data = $this->htheme_content->htheme_get_lookbooks($atts);

		#RETURN DATA/HTML
		return $htheme_data;

	}

	/************************************************
	 * VISUAL COMPOSER TEMPLATES
	 ************************************************/

	#REMOVE DEFAULTS
	public function htheme_remove_default_elements(){

		//vc_remove_element("vc_row");
		//vc_remove_element("vc_icon");
		//vc_remove_element("vc_column_text");

		#VARAIBLES
		$htheme_visual_elements = $GLOBALS['htheme_global_object']['settings']['visual']['visualElements'];

		#ALWAYS OFF / COMMENT OUT TO ENABLE ELEMENTS
		if($htheme_visual_elements == 'false'):

			vc_remove_element("vc_cta_button2");
			vc_remove_element("vc_button2");
			vc_remove_element("vc_masonry_media_grid");
			vc_remove_element("vc_masonry_grid");
			vc_remove_element("vc_masonry_grid");
			vc_remove_element("vc_media_grid");
			vc_remove_element("vc_basic_grid");
			vc_remove_element("vc_cta");
			vc_remove_element("vc_btn");
			vc_remove_element("vc_custom_heading");
			vc_remove_element("vc_empty_space");
			vc_remove_element("vc_line_chart");
			vc_remove_element("vc_round_chart");
			vc_remove_element("vc_pie");
			vc_remove_element("vc_raw_js");
			vc_remove_element("vc_raw_html");
			vc_remove_element("vc_video");
			vc_remove_element("vc_widget_sidebar");
			vc_remove_element("vc_tta_pageable");
			vc_remove_element("vc_tta_accordion");
			vc_remove_element("vc_tta_tour");
			vc_remove_element("vc_tta_tabs");
			vc_remove_element("vc_gallery");
			vc_remove_element("vc_gallery");
			vc_remove_element("vc_text_separator");
			vc_remove_element("vc_button");
			vc_remove_element("vc_posts_slider");
			vc_remove_element("vc_gmaps");
			vc_remove_element("vc_teaser_grid");
			vc_remove_element("vc_progress_bar");
			vc_remove_element("vc_facebook");
			vc_remove_element("vc_tweetmeme");
			vc_remove_element("vc_googleplus");
			vc_remove_element("vc_facebook");
			vc_remove_element("vc_pinterest");
			vc_remove_element("vc_message");
			vc_remove_element("vc_posts_grid");
			vc_remove_element("vc_carousel");
			vc_remove_element("vc_flickr");
			vc_remove_element("vc_tour");
			vc_remove_element("vc_separator");
			vc_remove_element("vc_single_image");
			vc_remove_element("vc_cta_button");
			vc_remove_element("vc_accordion");
			vc_remove_element("vc_accordion_tab");
			vc_remove_element("vc_toggle");
			vc_remove_element("vc_tabs");
			vc_remove_element("vc_tab");
			vc_remove_element("vc_images_carousel");
			vc_remove_element("vc_wp_archives");
			vc_remove_element("vc_wp_calendar");
			vc_remove_element("vc_wp_categories");
			vc_remove_element("vc_wp_custommenu");
			vc_remove_element("vc_wp_links");
			vc_remove_element("vc_wp_meta");
			vc_remove_element("vc_wp_pages");
			vc_remove_element("vc_wp_posts");
			vc_remove_element("vc_wp_recentcomments");
			vc_remove_element("vc_wp_rss");
			vc_remove_element("vc_wp_search");
			vc_remove_element("vc_wp_tagcloud");
			vc_remove_element("vc_wp_text");
			vc_remove_element("woocommerce_cart");
			vc_remove_element("woocommerce_checkout");
			vc_remove_element("woocommerce_order_tracking");
			vc_remove_element("woocommerce_my_account");
			vc_remove_element("recent_products");
			vc_remove_element("featured_products");
			vc_remove_element("product");
			vc_remove_element("products");
			vc_remove_element("add_to_cart");
			vc_remove_element("add_to_cart_url");
			vc_remove_element("product_page");
			vc_remove_element("product_category");
			vc_remove_element("product_categories");
			vc_remove_element("sale_products");
			vc_remove_element("best_selling_products");
			vc_remove_element("top_rated_products");
			vc_remove_element("product_attribute");

		endif;
	}

	#REMOVE ALL DEFAULT TEMPLATES
	public function htheme_my_custom_template_modify_array( $data ) {
		return array();
	}

	/************************************************
	 * VISUAL COMPOSER TEMPLATES
	 ************************************************/

	#TEST TEMPLATE HOOK
	public function htheme_my_custom_template_at_first_position( $data ) {
		$template               = array();
		$template['name']       = esc_html__( 'Custom template', 'invogue' ); // Assign name for your custom template
		$template['image_path'] = preg_replace( '/\s/', '%20', plugins_url( 'images/custom_template_thumbnail.jpg', __FILE__ ) ); // Always use preg replace to be sure that "space" will not break logic. Thumbnail should have this dimensions: 114x154px.
		$template['custom_class'] = 'custom_template_for_vc_custom_template'; // CSS class name
		$template['content']    = 'CONTENT';

		array_unshift( $data, $template );
		return $data;
	}

	/************************************************
	 * AUTOCOMPLETE FUNCTIONS
	 ************************************************/

	#AUTOCOMPLETE PRODUCT CATEGORIES
	public function htheme_get_product_category_autocomplete() {

		#ARGUMENTS
		$args = array(
			'taxonomy'     => 'product_cat',
			'orderby'      => 'name',
			'show_count'   => 1,
			'pad_counts'   => 1,
			'hierarchical' => 0,
			'hide_empty'   => 1
		);

		#GET CATEGORIES
		$the_categories = get_categories($args);

		#ARRAY
		$result = array();

		#SETUP RESULTS
		foreach ( $the_categories as $term )	{
			$result[] = array(
				'value' => $term->term_id,
				'label' => $term->name,
			);
		}

		#RETURN RESULTS
		return $result;

	}

	#AUTOCOMPLETE PRODUCTS
	public function htheme_get_product_autocomplete(){

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1,
			'hierarchical' => 0,
		);

		#GET PRODUCTS
		$products = get_posts($args);

		#ARRAY
		$result = array();

		#SETUP RESULTS
		foreach ( $products as $product )	{
			$result[] = array(
				'value' => $product->ID,
				'label' => $product->post_title,
			);
		}

		#RETURN RESULTS
		return $result;

	}

	#AUTOCOMPLETE PRODUCT CATEGORIES
	public function htheme_get_post_category_autocomplete() {

		#ARGUMENTS
		$args = array(
			'taxonomy'     => 'category',
			'orderby'      => 'name',
			'show_count'   => 1,
			'pad_counts'   => 1,
			'hierarchical' => 0,
			'hide_empty'   => 1
		);

		#GET CATEGORIES
		$the_categories = get_categories($args);

		#ARRAY
		$result = array();

		#SETUP RESULTS
		foreach ( $the_categories as $term )	{
			$result[] = array(
				'value' => $term->term_id,
				'label' => $term->name,
			);
		}

		#RETURN RESULTS
		return $result;

	}

	#AUTOCOMPLETE LOOKBOOKS
	public function htheme_get_post_lookbook_autocomplete() {

		#ARGUMENTS
		$args = array(
			'post_type'     => 'lookbook',
			'orderby'      => 'title',
			'show_count'   => 1,
			'pad_counts'   => 1,
			'hierarchical' => 0,
			'hide_empty'   => 1
		);

		#GET PRODUCTS
		$books = get_posts($args);

		#ARRAY
		$result = array();

		#SETUP RESULTS
		foreach ( $books as $post )	{
			$result[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
			);
		}

		#RETURN RESULTS
		return $result;

	}

	#AUTOCOMPLETE LOOKBOOKS
	public function htheme_get_post_people_autocomplete() {

		#ARGUMENTS
		$args = array(
			'post_type'     => 'people',
			'orderby'      => 'title',
			'show_count'   => 1,
			'pad_counts'   => 1,
			'hierarchical' => 0,
			'hide_empty'   => 1
		);

		#GET PRODUCTS
		$people = get_posts($args);

		#ARRAY
		$result = array();

		#SETUP RESULTS
		foreach ( $people as $post )	{
			$result[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
			);
		}

		#RETURN RESULTS
		return $result;

	}

	#AUTOCOMPLETE LOOKBOOKS
	public function htheme_get_testimonials_autocomplete() {

		#ARGUMENTS
		$args = array(
			'post_type'     => 'testimonial',
			'orderby'      => 'title',
			'show_count'   => 1,
			'pad_counts'   => 1,
			'hierarchical' => 0,
			'hide_empty'   => 1
		);

		#GET PRODUCTS
		$testimonials = get_posts($args);

		#ARRAY
		$result = array();

		#SETUP RESULTS
		foreach ( $testimonials as $post )	{
			$result[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
			);
		}

		#RETURN RESULTS
		return $result;

	}

}