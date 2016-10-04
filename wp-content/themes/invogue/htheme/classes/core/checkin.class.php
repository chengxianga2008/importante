<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

	#UPDATE MANAGEMENT
	class htheme_checkin{

		#CLASS VARS
		private $development_mode = false;
		private $theme_slug;
		private $theme_name;
		private $theme_friendly_name;
		private $theme_version;
		private $theme_uuid;
		private $installed;
		private $api_version;
		private $theme_checkin_url;
		private $theme_update_info_url;
		private $blog_url;

		#CONSTRUCT
		public function __construct($theme_slug,$theme_name,$theme_friendly_name,$api_version){
			//access globals
			global $htheme_helper;
			$htheme_helper = new htheme_helper();
			//define class vars
			$this->theme_slug = $theme_slug;
			$this->theme_name = $theme_name;
			$this->theme_friendly_name = $theme_friendly_name;
			$this->api_version = $api_version;
			//set blog url
			$this->blog_url = $htheme_helper->htheme_get_blog_domain();
			//get theme info
			$this->htheme_get_theme_info();
			//construct checkin link
			$this->theme_checkin_url = 'https://www.herodatacenter.com/theme/'. $this->api_version .'/checkin/'. $this->theme_slug .'/'. $this->theme_version .'/'. $this->theme_uuid .'/'. $this->installed .'/'. $this->blog_url .'/'. $this->development_mode;
		}

		#CHECKIN WITH API
		public function htheme_check_in($transient){
			//check transient
			if(empty($transient->checked)){
				return $transient;
			}
			//query the api
			$result = wp_remote_retrieve_body(wp_remote_get($this->theme_checkin_url));
			$result_object = json_decode($result);
			//check for success
			if(isset($result_object) && $result_object->status == 200){
				//get data
				$lastest_version = $result_object->data->version;
				$download_link = $result_object->data->download_link;
				$url = $result_object->data->url;
				//check current version
				if(version_compare($lastest_version .'', $this->theme_version, ">")){
					//new version available
					$obj = array();
					$obj['theme'] = $this->theme_slug; //theme slug
					$obj['new_version'] = $lastest_version; //new version number
					$obj['url'] = $url; //link to changelog
					$obj['package'] = $download_link; //link to download file
					//append to transient
					$transient->response[$this->theme_slug] = $obj;
					//return transient to WP
					return $transient;
				}
			}
			return $transient;
		}

		#GET THEME INFORMATION FROM DB
		private function htheme_get_theme_info(){ //extract info from db
			global $wpdb;
			if($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $wpdb->base_prefix."htheme_root")) == $wpdb->base_prefix ."htheme_root"){
				$theme_lookup = $wpdb->get_results($wpdb->prepare("SELECT `theme_version`, `theme_uuid`, DATE(`date_created`) AS 'installed' FROM `". $wpdb->base_prefix ."htheme_root` WHERE `theme_name` = %s;", $this->theme_name));
				if($theme_lookup){
					$this->theme_version = $theme_lookup[0]->theme_version;
					$this->theme_uuid = $theme_lookup[0]->theme_uuid;
					$this->installed = str_replace('-','',$theme_lookup[0]->installed);
					return true;
				}
			}
			return false;
		}

	}