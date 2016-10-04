<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#HERO PEOPLE POST TYPE
class htheme_lookbook {

	var $singular_label;
	var $token;
	var $rewrite_path;
	var $description;

	function __construct() {

		#SETUP GLOBAL VARIABLES
		$this->singular_label = 'Lookbooks';
		$this->plural_label = 'Lookbooks';
		$this->token = 'lookbook';
		$this->rewrite_path = 'lookbook';
		$this->description = 'A list of Lookbooks.';

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
			'supports'           	=> 	array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' )
		);

		register_post_type( $this->token, $args );
	}

	#METABOX FUNCTION
	function meta_box_eventdata () {

		global $post;

		$box_content = '';

		$box_content .= '<input type="hidden" name="hero_' . $this->token . '_noonce" id="hero_' . $this->token . '_noonce" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

		#META VARIABLES
		$htheme_meta_image_gallery = get_post_meta($post->ID, 'htheme_meta_image_gallery', true);

		echo '<script>';
		echo 'var global_theme_directory = "' . get_template_directory_uri() . '"';
		echo '</script>';

		//META BOX HOLDER
		$box_content .= '<div class="htheme_metabox_holder">';

			$box_content .= '<div class="htheme_form_row">';
				$box_content .= '<div class="htheme_form_col_3">';
					$box_content .= '<div class="htheme_label">Lookbook gallery.</div>';
					$box_content .= '<div class="htheme_label_excerpt">Upload multiple images to create a gallery for your lookbook.</div>';
					$box_content .= '</div>';
				$box_content .= '<div class="htheme_form_col_9">';
					$box_content .= '<div class="htheme_button htheme_dark_btn htheme_media_uploader" data-connect="htheme_meta_image_gallery" data-multiple="true" data-size="full">';
						$box_content .= 'Upload';
						$box_content .= '</div>';
					$box_content .= '<input type="hidden" name="htheme_meta_image_gallery" id="htheme_meta_image_gallery" class="htheme_field_fixed_400" value="' . esc_attr( $htheme_meta_image_gallery ) . '">';
					$box_content .= '</div>';
				$box_content .= '<div class="htheme_form_col_12">';
					$box_content .= '<div class="htheme_image_holder htheme_gallery_holder" id="image_htheme_meta_image_gallery"></div>';
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
		$fields = array( 'htheme_meta_image_gallery' );

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
			add_meta_box( 'events_data', 'Lookbook Details', array(&$this, 'meta_box_eventdata'), $this->token, 'normal', 'low');
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
$htheme_posttype_lookbooks = new htheme_lookbook();