<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#HERO PEOPLE POST TYPE
class htheme_people {

	var $singular_label;
	var $token;
	var $rewrite_path;
	var $description;

	function __construct() {

		#SETUP GLOBAL VARIABLES
		$this->singular_label = 'Our People';
		$this->plural_label = 'Members';
		$this->token = 'people';
		$this->rewrite_path = 'people';
		$this->description = 'A list of Team Members.';

		#RUN ACTIONS
		add_action( 'init', array( &$this, 'register_post_type' ) );
		add_action( 'template_redirect', array( &$this, 'load_template' ) );

		#META HOOKS
		add_action ( 'admin_menu', array( &$this, 'create_meta_boxes' ) );
		add_action ( 'save_post', array( &$this, 'save_meta_box_eventdata' ) );

	}

	#REGISTER POST TYPE FUNCTION
	function register_post_type () {

		#POST TYPE LABELS
		$labels = array(
			'name'					=>	$this->plural_label,
			'singular_name'      	=> 	$this->singular_label,
			'add_new'            	=> 	'Add New',
			'add_new_item'       	=> 	'Add New ' . $this->singular_label,
			'edit_item'          	=> 	'Edit ' . $this->singular_label,
			'new_item'          	=> 	'New ' . $this->singular_label,
			'all_items'         	=> 	'All  ' . $this->plural_label,
			'view_item'         	=> 	'View ' . $this->singular_label,
			'search_items'       	=> 	'Search ' . $this->plural_label,
			'not_found'          	=> 	'No '. $this->plural_label .' found',
			'not_found_in_trash' 	=> 	'No '. $this->plural_label .' found in Trash',
			'parent_item_colon'  	=> 	'',
			'menu_name'          	=> 	$this->plural_label
		);

		#POST TYPE ARGUMENTS
		$args = array (
			'labels'            	=> 	$labels,
			'public'             	=> 	true,
			'publicly_queryable' 	=> 	true,
			'show_ui'            	=> 	true,
			'show_in_menu'       	=> 	true,
			'menu_icon' 			=> 	get_template_directory_uri().'/htheme/assets/images/settings/admin_people_icon.png',
			'query_var'          	=> 	true,
			'rewrite'            	=> 	array( 'slug' => $this->token ),
			'capability_type'    	=> 	'post',
			'has_archive'        	=> 	true,
			'hierarchical'       	=> 	false,
			'menu_position'      	=> 	100,
			'supports'           	=> 	array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' )
		);

		register_post_type( $this->token, $args );
	}

	#METABOX FUNCTION
	function meta_box_eventdata () {

		global $post;

		$box_content = '';

		$box_content .= '<input type="hidden" name="hero_' . $this->token . '_noonce" id="hero_' . $this->token . '_noonce" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

		#META VARIABLES
		$htheme_meta_type_position = get_post_meta($post->ID, 'htheme_meta_type_position', true);
		$htheme_meta_type_facebook = get_post_meta($post->ID, 'htheme_meta_type_facebook', true);
		$htheme_meta_type_twitter = get_post_meta($post->ID, 'htheme_meta_type_twitter', true);
		$htheme_meta_type_pinterest = get_post_meta($post->ID, 'htheme_meta_type_pinterest', true);
		$htheme_meta_type_linkd = get_post_meta($post->ID, 'htheme_meta_type_linkd', true);
		$htheme_meta_type_background_image = get_post_meta($post->ID, 'htheme_meta_image', true);
		$htheme_meta_type_image_signature = get_post_meta($post->ID, 'htheme_meta_type_image_signature', true);
		$htheme_meta_type_primary_color = get_post_meta($post->ID, 'htheme_meta_type_primary_color', true);
		$htheme_meta_type_secondary_color = get_post_meta($post->ID, 'htheme_meta_type_secondary_color', true);
		$htheme_meta_social_primary_color = get_post_meta($post->ID, 'htheme_meta_social_primary_color', true);
		$htheme_meta_social_secondary_color = get_post_meta($post->ID, 'htheme_meta_social_secondary_color', true);

		echo '<script>';
		echo 'var global_theme_directory = "' . get_template_directory_uri() . '"';
		echo '</script>';

		//META BOX HOLDER
		$box_content .= '<div class="htheme_metabox_holder">';

			$box_content .= '<div class="htheme_form_row">';
				$box_content .= '<div class="htheme_form_col_12">';
					$box_content .= '<div class="htheme_form_col_3">';
						$box_content .= '<div class="htheme_label">Position/Title</div>';
						$box_content .= '<div class="htheme_label_excerpt">Set the title for the current member.</div>';
						$box_content .= '</div>';
					$box_content .= '<div class="htheme_form_col_9">';
						$box_content .= '<input type="text" name="htheme_meta_type_position" id="htheme_meta_type_position" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_type_position ) . '">';
					$box_content .= '</div>';
				$box_content .= '</div>';
			$box_content .= '</div>';

			$box_content .= '<div class="htheme_form_row">';
				$box_content .= '<div class="htheme_form_col_3">';
					$box_content .= '<div class="htheme_label">Single Page Background image upload</div>';
					$box_content .= '<div class="htheme_label_excerpt">The image should be between 1600px - 2000px wide and have a minimum height of 550px for best results. Click "Browse" to upload and then "Insert into Post".</div>';
					$box_content .= '</div>';
				$box_content .= '<div class="htheme_form_col_9">';
					$box_content .= '<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="htheme_meta_image" data-multiple="false" data-size="full">';
						$box_content .= 'Upload';
						$box_content .= '</div>';
					$box_content .= '<input type="hidden" name="htheme_meta_image" id="htheme_meta_image" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_type_background_image ) . '">';
					$box_content .= '</div>';
				$box_content .= '<div class="htheme_form_col_12">';
					$box_content .= '<div class="htheme_image_holder" id="image_htheme_meta_image"></div>';
				$box_content .= '</div>';
			$box_content .= '</div>';

			$box_content .= '<div class="htheme_form_row">';
				$box_content .= '<div class="htheme_form_col_3">';
					$box_content .= '<div class="htheme_label">Single Page Signature upload</div>';
					$box_content .= '<div class="htheme_label_excerpt">Please make sure you signature is high res.</div>';
					$box_content .= '</div>';
				$box_content .= '<div class="htheme_form_col_9">';
					$box_content .= '<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="htheme_meta_type_image_signature" data-multiple="false" data-size="full">';
						$box_content .= 'Upload';
						$box_content .= '</div>';
					$box_content .= '<input type="hidden" name="htheme_meta_type_image_signature" id="htheme_meta_type_image_signature" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_type_image_signature ) . '">';
					$box_content .= '</div>';
				$box_content .= '<div class="htheme_form_col_12">';
					$box_content .= '<div class="htheme_image_holder" id="image_htheme_meta_type_image_signature"></div>';
				$box_content .= '</div>';
			$box_content .= '</div>';

			//PRIMARY COLOR ONE
			$box_content .=  '<div class="htheme_form_row">';
				$box_content .=  '<div class="htheme_form_col_3">';
					$box_content .=  '<div class="htheme_label">Primary Color</div>';
					$box_content .=  '<div class="htheme_label_excerpt">Add a Primary font color for the single page title.</div>';
					$box_content .=  '</div>';
				$box_content .=  '<div class="htheme_form_col_9">';
					$box_content .=  '<input name="htheme_meta_type_primary_color" id="htheme_meta_type_primary_color" class="htheme_color_picker" value="' . esc_attr( $htheme_meta_type_primary_color ) . '">';
				$box_content .=  '</div>';
			$box_content .= '</div>';

			//PRIMARY COLOR ONE
			$box_content .=  '<div class="htheme_form_row">';
				$box_content .=  '<div class="htheme_form_col_3">';
					$box_content .=  '<div class="htheme_label">Secondary Color</div>';
					$box_content .=  '<div class="htheme_label_excerpt">Add a Secondary font color for the single page title.</div>';
					$box_content .=  '</div>';
				$box_content .=  '<div class="htheme_form_col_9">';
					$box_content .=  '<input name="htheme_meta_type_secondary_color" id="htheme_meta_type_secondary_color" class="htheme_color_picker" value="' . esc_attr( $htheme_meta_type_secondary_color ) . '">';
				$box_content .=  '</div>';
			$box_content .= '</div>';

			//PRIMARY COLOR ONE
			$box_content .=  '<div class="htheme_form_row">';
			$box_content .=  '<div class="htheme_form_col_3">';
			$box_content .=  '<div class="htheme_label">Social Primary Color</div>';
			$box_content .=  '<div class="htheme_label_excerpt">Add a Primary color for social.</div>';
			$box_content .=  '</div>';
			$box_content .=  '<div class="htheme_form_col_9">';
			$box_content .=  '<input name="htheme_meta_social_primary_color" id="htheme_meta_social_primary_color" class="htheme_color_picker" value="' . esc_attr( $htheme_meta_social_primary_color ) . '">';
			$box_content .=  '</div>';
			$box_content .= '</div>';

			//PRIMARY COLOR ONE
			$box_content .=  '<div class="htheme_form_row">';
			$box_content .=  '<div class="htheme_form_col_3">';
			$box_content .=  '<div class="htheme_label">Social Hover Color</div>';
			$box_content .=  '<div class="htheme_label_excerpt">Add a Hover color for social.</div>';
			$box_content .=  '</div>';
			$box_content .=  '<div class="htheme_form_col_9">';
			$box_content .=  '<input name="htheme_meta_social_secondary_color" id="htheme_meta_social_secondary_color" class="htheme_color_picker" value="' . esc_attr( $htheme_meta_social_secondary_color ) . '">';
			$box_content .=  '</div>';
			$box_content .= '</div>';

			$box_content .= '<div class="htheme_form_row">';
				$box_content .= '<div class="htheme_form_col_12">';
					$box_content .= '<div class="htheme_form_col_3">';
						$box_content .= '<div class="htheme_label">Facebook URL</div>';
						$box_content .= '<div class="htheme_label_excerpt">Set the Facebook URL for the memeber.</div>';
						$box_content .= '</div>';
					$box_content .= '<div class="htheme_form_col_9">';
						$box_content .= '<input type="text" name="htheme_meta_type_facebook" id="htheme_meta_type_facebook" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_type_facebook ) . '">';
					$box_content .= '</div>';
				$box_content .= '</div>';
				$box_content .= '<div class="htheme_form_col_12" style="padding-top:10px;">';
					$box_content .= '<div class="htheme_form_col_3">';
						$box_content .= '<div class="htheme_label">Twitter URL</div>';
						$box_content .= '<div class="htheme_label_excerpt">Set the Twitter URL for the memeber.</div>';
						$box_content .= '</div>';
					$box_content .= '<div class="htheme_form_col_9">';
						$box_content .= '<input type="text" name="htheme_meta_type_twitter" id="htheme_meta_type_twitter" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_type_twitter ) . '">';
					$box_content .= '</div>';
				$box_content .= '</div>';
				$box_content .= '<div class="htheme_form_col_12" style="padding-top:10px;">';
					$box_content .= '<div class="htheme_form_col_3">';
						$box_content .= '<div class="htheme_label">Pinterest URL</div>';
						$box_content .= '<div class="htheme_label_excerpt">Set the Pinterest URL for the memeber.</div>';
						$box_content .= '</div>';
					$box_content .= '<div class="htheme_form_col_9">';
						$box_content .= '<input type="text" name="htheme_meta_type_pinterest" id="htheme_meta_type_pinterest" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_type_pinterest ) . '">';
					$box_content .= '</div>';
				$box_content .= '</div>';
				$box_content .= '<div class="htheme_form_col_12" style="padding-top:10px;">';
					$box_content .= '<div class="htheme_form_col_3">';
						$box_content .= '<div class="htheme_label">LinkdIn URL</div>';
						$box_content .= '<div class="htheme_label_excerpt">Set the LinkdIn URL for the memeber.</div>';
						$box_content .= '</div>';
					$box_content .= '<div class="htheme_form_col_9">';
						$box_content .= '<input type="text" name="htheme_meta_type_linkd" id="htheme_meta_type_linkd" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_type_linkd ) . '">';
					$box_content .= '</div>';
				$box_content .= '</div>';
			$box_content .= '</div>';

		$box_content .= '</div>';

		echo $box_content;

	}

	#SAVE META BOX DATA
	function save_meta_box_eventdata ( $post_id ) {

		global $post;

		if(!isset($post) || $post->post_type != $this->token){
			return $post_id;
		}

		#VERIFY
		if ( !wp_verify_nonce( $_POST['hero_' . $this->token . '_noonce'], plugin_basename(__FILE__) )) {
			return $post_id;
		}

		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) {
				return $post_id;
			}
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) {
				return $post_id;
			}
		}

		#FIELDS TO SAVE
		$fields = array( 'htheme_meta_type_position', 'htheme_meta_type_facebook', 'htheme_meta_type_twitter', 'htheme_meta_type_pinterest', 'htheme_meta_type_linkd', 'htheme_meta_image', 'htheme_meta_type_image_signature', 'htheme_meta_type_primary_color', 'htheme_meta_type_secondary_color', 'htheme_meta_social_primary_color', 'htheme_meta_social_secondary_color' );

		foreach ( $fields as $f ) {

			${$f} = strip_tags(trim($_POST[$f]));

			#SAVE POST META
			if(get_post_meta($post_id, $f) == "") {
				add_post_meta($post_id, $f, ${$f}, true);
			}
			#UPDATE POST META
			elseif(${$f} != get_post_meta($post_id, $f, true)) {
				update_post_meta($post_id, $f, ${$f});
			}
			#DELETE POST META
			elseif(${$f} == "") {
				delete_post_meta($post_id, $f, get_post_meta($post_id, $f, true) );
			}
		}
	}

	#CREATE METABOXES
	function create_meta_boxes () {
		if ( function_exists('add_meta_box') ) {
			add_meta_box( 'events_data', 'Member Details', array(&$this, 'meta_box_eventdata'), $this->token, 'normal', 'low');
		} else {
			add_action('dbx_post_advanced', array(&$this, 'meta_box_eventdata'));
		}
	}

	#LOAD TEMPLATES
	function load_template () {
		if ( is_page( $this->rewrite_path ) && file_exists( get_stylesheet_directory() . '/' . $this->rewrite_path . '.php' ) ) {
			get_template_part( get_stylesheet_directory() . '/' . $this->rewrite_path . '.php' );
			exit;
		}
	}

}

#ENABLE CLASS
$htheme_posttype_people = new htheme_people();