<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */
	
	#THEME HELPER
	class htheme_helper{

		#GEN GUID
		public function htheme_genGUID(){
			return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
				mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
				mt_rand(0, 0x0fff) | 0x4000,
				mt_rand(0, 0x3fff) | 0x8000,
				mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
			);
		}
		
		#GET BLOG URL
		public function htheme_get_blog_domain(){
			if(isset($_SERVER['HTTP_HOST'])){
				return $_SERVER['HTTP_HOST'];
			}
			return $_SERVER['SERVER_NAME'];
		}

	}