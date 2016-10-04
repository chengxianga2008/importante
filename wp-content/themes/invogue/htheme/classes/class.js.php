<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#HERO CSS SETUP
class htheme_js{

	#CONSTRUCT
	public function __construct(){
	}

	#CREATE CSS
	public function htheme_create_sharethis(){

		#VARIABLES
		$htheme_js = '';

		$htheme_js .= 'stLight.options({publisher: "54c6d7d6-c57e-409b-bc9c-43822cf28955", doNotHash: false, doNotCopy: false, hashAddressBar: false});';

		return $htheme_js;

	}

	#BEFORE CUSTOM JS CODE
	public function htheme_create_before_js(){

		#VARIABLES
		$htheme_custom_head = $GLOBALS['htheme_global_object']['settings']['general']['codeHead'];
		$htheme_js = '';

		$htheme_js .= $htheme_custom_head;

		return $htheme_js;

	}

	#FOOTER JS CODE
	public function htheme_create_footer_js(){

		#VARIABLES
		$htheme_custom_body = $GLOBALS['htheme_global_object']['settings']['general']['codeBody'];
		$htheme_js = '';

		$htheme_js .= $htheme_custom_body;

		return $htheme_js;

	}

	#CREATE CSS
	public function htheme_get_pageload_js(){

		#VARIABLES
		$htheme_js = '';

		$htheme_js .= 'jQuery(function(){ htheme_page_load(); jQuery(window).on(\'blur focus\', function(){ htheme_page_load(); }); });';

		return $htheme_js;

	}

}