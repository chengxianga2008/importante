<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#HERO AJAX CALL SETUP
class htheme_ajax{

	#VARIABLES
	public $htheme_ajax_calls_array;
	public $htheme_ajax_frontend_calls_array;
	public $htheme_ajax_frontend_forms_array;
	public $backend;
	public $frontend;

	#CONSTRUCT
	public function __construct($backend ,$woo , $forms){

		#GET ARRAY DATA
		$this->htheme_ajax_calls_array = $this->htheme_get_ajax_calls();

		#GET FRONTEND ARRAY DATA
		if($woo != NULL){
			$this->htheme_ajax_frontend_calls_array = $this->htheme_get_woo_ajax_calls();
		}

		#GET FORMS DATA
		$this->htheme_ajax_frontend_forms_array = $this->htheme_get_forms_ajax_calls();

		#SET ADMIN BACKEND CALL IDENTIFIER
		$this->backend = $backend;
		if($woo != NULL){
			$this->woo = $woo;
		}
		$this->forms = $forms;

		#ADD ACTIONS
		$this->htheme_set_ajax_calls();
		if($woo != NULL){
			$this->htheme_set_woo_ajax_calls();
		}
		$this->htheme_set_forms_ajax_calls();

	}

	#ADD AJAX HOOKS
	public function htheme_set_ajax_calls() {

		#ADD AJAX CALL ACTION
		if(isset($this->htheme_ajax_calls_array) && count($this->htheme_ajax_calls_array) > 0){
			foreach($this->htheme_ajax_calls_array as $call){
				add_action( 'wp_ajax_'. $call['action'], array(&$this->backend, $call['method']) );
			}
		}

	}

	public function htheme_get_ajax_calls(){

		#ADMIN AJAX ARRAY CALLS
		$array = array(
			array('action' => 'htheme_object_save','method' => 'htheme_save_options'),
			array('action' => 'htheme_object_get','method' => 'htheme_get_options'),
			array('action' => 'htheme_set_page_shortcode','method' => 'htheme_set_page_shortcode'),
			array('action' => 'htheme_get_pages','method' => 'htheme_get_pages'),
			array('action' => 'htheme_generate_options_string','method' => 'htheme_generate_options_string'),
			array('action' => 'htheme_import_options_string','method' => 'htheme_import_options_string'),
			array('action' => 'htheme_demo_install','method' => 'htheme_demo_install'),
			array('action' => 'htheme_get_signups','method' => 'htheme_get_signups'),
			array('action' => 'htheme_get_backend_pages','method' => 'htheme_get_backend_pages'),
			array('action' => 'htheme_write_file','method' => 'htheme_write_file'),
		);

		#RETURN
		return $array;

	}

	#ADD AJAX HOOKS
	public function htheme_set_woo_ajax_calls() {

		#ADD AJAX CALL ACTION
		if(isset($this->htheme_ajax_frontend_calls_array) && count($this->htheme_ajax_frontend_calls_array) > 0){
			foreach($this->htheme_ajax_frontend_calls_array as $call){
				add_action('wp_ajax_'. $call['action'], array(&$this->woo, $call['method']));
				add_action('wp_ajax_nopriv_'. $call['action'], array(&$this->woo, $call['method']));
			}
		}

	}

	#LIST OF AJAX CALLS
	public function htheme_get_woo_ajax_calls(){

		#ADMIN AJAX ARRAY CALLS
		$array = array(
			array('action' => 'htheme_ajax_loadmore','method' => 'htheme_get_woo_product_list'),
			array('action' => 'htheme_get_nav_cart_data','method' => 'htheme_get_nav_cart_data'),
			array('action' => 'htheme_remove_cart_item','method' => 'htheme_remove_cart_item'),
			array('action' => 'htheme_get_nav_wishlist_data','method' => 'htheme_get_nav_wishlist_data'),
			array('action' => 'htheme_ajax_get_preview','method' => 'htheme_get_preview'),
			array('action' => 'htheme_add_wishlist_item','method' => 'htheme_add_nav_wishlist_item'),
		);

		#RETURN
		return $array;

	}

	#ADD FORMS AJAX HOOKS
	public function htheme_set_forms_ajax_calls() {

		#ADD AJAX CALL ACTION
		if(isset($this->htheme_ajax_frontend_forms_array) && count($this->htheme_ajax_frontend_forms_array) > 0){
			foreach($this->htheme_ajax_frontend_forms_array as $call){
				add_action('wp_ajax_'. $call['action'], array(&$this->forms, $call['method']));
				add_action('wp_ajax_nopriv_'. $call['action'], array(&$this->forms, $call['method']));
			}
		}

	}

	#LIST OF AJAX CALLS
	public function htheme_get_forms_ajax_calls(){

		#ADMIN AJAX ARRAY CALLS
		$array = array(
			array('action' => 'htheme_check_forms','method' => 'htheme_check_forms'),
			array('action' => 'htheme_set_signup_session','method' => 'htheme_set_signup_session'),
		);

		#RETURN
		return $array;

	}

}