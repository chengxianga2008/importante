<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO FRONTEND CLASS
class htheme_frontend{

	#CONSTRUCT
	public function __construct(){

	}

	#GET OPTIONS
	public function htheme_get_options(){

		#GET OPTION DATA
		$options = get_option( 'hero_theme_options' );

		#RETURN WOO CONTENT
		return $options;

	}

}