<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */
		
	#ACTIVATE THEME
	class htheme_activate{
		
		#CLASS VARS
		private $theme_name;
		private $theme_version;
		private $theme_old_version;
		
		#CONSTRUCT
		public function __construct($theme_name,$theme_version){
			//define class vars
			$this->theme_name = $theme_name;
			$this->theme_version = $theme_version;
			//update check
			$this->htheme_update_check();
		}
		
		#CHECK FOR UPGRADE
		private function htheme_update_check(){
			global $wpdb;
			if($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $wpdb->base_prefix."htheme_root")) == $wpdb->base_prefix ."htheme_root"){
				$theme_lookup = $wpdb->get_results($wpdb->prepare("SELECT * FROM `" . $wpdb->base_prefix . "htheme_root` WHERE `theme_name` = %s;", $this->theme_name));
				if($theme_lookup){
					$this->theme_old_version = $theme_lookup[0]->theme_version;
					if(version_compare($this->theme_old_version, $this->theme_version, '<')){
						$update = new htheme_update_theme($this->theme_name, $this->theme_version, $this->theme_old_version);
						$update->htheme_update_theme();
					}
				}
			}
		}

		#ACTIVATE
		private function htheme_activate(){
			//access globals
			global $wpdb;
			global $htheme_helper;
			$htheme_helper = new htheme_helper();
			//create the htheme_root table if it doesn't exist
			$sql_create = "
				CREATE TABLE IF NOT EXISTS `". $wpdb->base_prefix ."htheme_root` (
				  `htheme_id` int(11) NOT NULL AUTO_INCREMENT,
				  `theme_name` varchar(45) NOT NULL,
				  `theme_version` varchar(10) NOT NULL,
				  `theme_uuid` varchar(36) NOT NULL,
				  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  `last_modified` datetime DEFAULT NULL,
				  `active` tinyint(1) NOT NULL DEFAULT '1',
				  `deleted` tinyint(1) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`htheme_id`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;
			";
			$wpdb->query($sql_create);
			$sql_drop = "
				DROP TRIGGER IF EXISTS `". $wpdb->base_prefix ."htheme_root`;
			";
			$wpdb->query($sql_drop);
			$sql_create = "
				CREATE TRIGGER `". $wpdb->base_prefix ."htheme_root`
				BEFORE UPDATE ON `". $wpdb->base_prefix ."htheme_root`
				FOR EACH ROW SET NEW.last_modified = NOW();
			";
			$wpdb->query($sql_create);
			//check if theme exists in htheme_root table
			$theme_lookup = $wpdb->get_results($wpdb->prepare("SELECT * FROM `". $wpdb->base_prefix ."htheme_root` WHERE `theme_name` = %s;", $this->theme_name));
			if(!$theme_lookup){ //add if not exists
				$wpdb->query($wpdb->prepare("INSERT INTO `". $wpdb->base_prefix ."htheme_root` (`theme_name`,`theme_version`,`theme_uuid`) VALUES(%s,'". $this->theme_version ."','". $htheme_helper->htheme_genGUID() ."');", $this->theme_name));
			}else{ //ensure that deleted = 0
				$wpdb->query($wpdb->prepare("UPDATE `". $wpdb->base_prefix ."htheme_root` SET `deleted` = 0, `active` = 1 WHERE `theme_name` = %s;", $this->theme_name));
			}
		}
		
		#SETUP THEME
		public function htheme_setup_theme(){
			//activate theme
			$this->htheme_activate();
		}

	}