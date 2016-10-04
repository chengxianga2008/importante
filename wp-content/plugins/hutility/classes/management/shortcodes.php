<?php
		
	#UTILITY SHORTCODES
	class hutility_shortcodes{

		#CONSTRUCT
		public function __construct(){

			#INSTANTIATE CLASS
			if ( defined( 'WPB_VC_VERSION' ) && class_exists('htheme_getcontent')) {
				$this->content_shortcodes();
			}
			if( defined( 'WPB_VC_VERSION' ) && class_exists('htheme_getwoo') && class_exists('WooCommerce') ){
				$this->woo_shortcodes();
			}

		}
		
		#GET CONTENT SHORTCODES
		public function content_shortcodes(){

			$htheme_composer = new htheme_composer();

			add_shortcode( 'htheme_line_slug', array($htheme_composer, 'htheme_line_shortcode') );
			add_shortcode( 'htheme_map_slug', array($htheme_composer, 'htheme_map_shortcode') );
			add_shortcode( 'htheme_signup_slug', array($htheme_composer, 'htheme_signup_shortcode') );
			add_shortcode( 'htheme_contact_slug', array($htheme_composer, 'htheme_contact_shortcode') );
			add_shortcode( 'htheme_banner_slug', array($htheme_composer, 'htheme_banner_shortcode') );
			add_shortcode( 'htheme_launch_slug', array($htheme_composer, 'htheme_launch_shortcode') );
			add_shortcode( 'htheme_people_slug', array($htheme_composer, 'htheme_people_shortcode') );
			add_shortcode( 'htheme_title_slug', array($htheme_composer, 'htheme_title_shortcode') );
			add_shortcode( 'htheme_blog_slug', array($htheme_composer, 'htheme_blog_shortcode') );
			add_shortcode( 'htheme_blog_carousel_slug', array($htheme_composer, 'htheme_blog_carousel_shortcode') );
			add_shortcode( 'htheme_testimonial_slug', array($htheme_composer, 'htheme_testimonial_shortcode') );
			add_shortcode( 'htheme_instagram_slug', array($htheme_composer, 'htheme_instagram_shortcode') );
			add_shortcode( 'htheme_imgcarousel_slug', array($htheme_composer, 'htheme_imgcarousel_shortcode') );
			add_shortcode( 'htheme_lookbooks_slug', array($htheme_composer, 'htheme_lookbooks_shortcode') );

		}

		#WOO SHORTCODES
		public function woo_shortcodes(){

			$htheme_composer = new htheme_composer();

			add_shortcode( 'htheme_woolist_slug', array($htheme_composer, 'htheme_woolist_shortcode') );
			add_shortcode( 'htheme_woocategory_slug', array($htheme_composer, 'htheme_woocategory_shortcode') );
			add_shortcode( 'htheme_promo_slug', array($htheme_composer, 'htheme_promo_shortcode') );
			add_shortcode( 'htheme_topten_slug', array($htheme_composer, 'htheme_top_ten_shortcode') );
			add_shortcode( 'htheme_look_slug', array($htheme_composer, 'htheme_look_shortcode') );
			add_shortcode( 'htheme_woocol_slug', array($htheme_composer, 'htheme_woocol_shortcode') );

		}
		
	}

	new hutility_shortcodes();