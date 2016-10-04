<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#HERO PEOPLE POST TYPE
class htheme_faq {

	var $singular_label;
	var $token;
	var $rewrite_path;
	var $description;

	function __construct() {

		#SETUP GLOBAL VARIABLES
		$this->singular_label = 'FAQ';
		$this->plural_label = 'FAQ\'s';
		$this->token = 'faq';
		$this->rewrite_path = 'faq';
		$this->description = 'A list of faq\'s.';

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
			'supports'           	=> 	array( 'title', 'editor', 'page-attributes' )
		);

		register_post_type( $this->token, $args );
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
		$fields = array();

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
			//add_meta_box( 'events_data', 'Member Details', array(&$this, 'meta_box_eventdata'), $this->token, 'normal', 'low');
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
$htheme_posttype_faq = new htheme_faq();
