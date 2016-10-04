<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#HERO TESTIMONIAL POST TYPE
class htheme_testimonial {

	var $singular_label;
	var $token;
	var $rewrite_path;
	var $description;

	function __construct() {

		#SETUP GLOBAL VARIABLES
		$this->singular_label = 'List of Testimonials';
		$this->plural_label = 'Testimonials';
		$this->token = 'testimonial';
		$this->rewrite_path = 'testimonial';
		$this->description = 'A list of user Testimonials.';

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
			'supports'           	=> 	array( 'title', 'thumbnail', 'excerpt', 'page-attributes' )
		);

		register_post_type( $this->token, $args );
	}	

	#METABOX FUNCTION
	function meta_box_eventdata () {

		global $post;

		$box_content = '';

		$box_content .= '<input type="hidden" name="hero_' . $this->token . '_noonce" id="hero_' . $this->token . '_noonce" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

		#META VARIABLES
		$htheme_meta_name = get_post_meta($post->ID, 'htheme_meta_name', true);
		$htheme_meta_company = get_post_meta($post->ID, 'htheme_meta_company', true);
		$htheme_meta_rating = get_post_meta($post->ID, 'htheme_meta_rating', true);

		echo '<script>';
		echo 'var global_theme_directory = "' . get_template_directory_uri() . '"';
		echo '</script>';

		//META BOX HOLDER
		$box_content .= '<div class="htheme_metabox_holder">';

			$box_content .= '<div class="htheme_form_row">';
				$box_content .= '<div class="htheme_form_col_12">';
					$box_content .= '<div class="htheme_form_col_3">';
						$box_content .= '<div class="htheme_label">User name</div>';
						$box_content .= '</div>';
					$box_content .= '<div class="htheme_form_col_9">';
						$box_content .= '<input type="text" name="htheme_meta_name" id="htheme_meta_name" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_name ) . '">';
					$box_content .= '</div>';
				$box_content .= '</div>';
			$box_content .= '</div>';

			$box_content .= '<div class="htheme_form_row">';
			$box_content .= '<div class="htheme_form_col_12">';
			$box_content .= '<div class="htheme_form_col_3">';
			$box_content .= '<div class="htheme_label">Company</div>';
			$box_content .= '</div>';
			$box_content .= '<div class="htheme_form_col_9">';
			$box_content .= '<input type="text" name="htheme_meta_company" id="htheme_meta_company" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_company ) . '">';
			$box_content .= '</div>';
			$box_content .= '</div>';
			$box_content .= '</div>';

			$box_content .= '<div class="htheme_form_row">';
			$box_content .= '<div class="htheme_form_col_12">';
			$box_content .= '<div class="htheme_form_col_3">';
			$box_content .= '<div class="htheme_label">Rating</div>';
			$box_content .= '</div>';
			$box_content .= '<div class="htheme_form_col_9">';
			$box_content .= '<select name="htheme_meta_rating" id="htheme_meta_rating" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_rating ) . '">';
			$options_meta_ratings = array(1, 2, 3, 4, 5);
			foreach($options_meta_ratings as $option){
				if($htheme_meta_rating == $option){
					$box_content .= '<option selected="selected" value="'.$option.'">'.$option.' - Star Rating</option>';
				} else {
					$box_content .= '<option value="'.$option.'">'.$option.' - Star Rating</option>';
				}
			}
			$box_content .= '</select>';
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
		$fields = array( 'htheme_meta_name', 'htheme_meta_company', 'htheme_meta_rating' );

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
			add_meta_box( 'events_data', 'User Details', array(&$this, 'meta_box_eventdata'), $this->token, 'normal', 'low');
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
$htheme_posttype_testimonial = new htheme_testimonial();