<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */
	
	#UPDATE THEME
	class htheme_update_theme{
		
		#CLASS VARS
		private $theme_name;
		private $theme_version;
		private $theme_old_version;
		private $object_manager;
		
		#CONSTRUCT
		public function __construct($theme_name,$theme_version,$theme_old_version){
			//set class vars
			$this->theme_name = $theme_name;
			$this->theme_version = $theme_version;
			$this->theme_old_version = $theme_old_version;
			$this->object_manager = new htheme_update_object();
		}
		
		#UPDATE THEME
		public function htheme_update_theme(){
			//access globals
			global $wpdb;
			//update theme tables
			/*
				-- update your theme specific tables here --
				
				note: This should be version specific.				
			*/
			//update existing database objects with default object data
			$this->object_manager->htheme_update_database_objects();
			//flush rewrite rules
			flush_rewrite_rules();
			//mark the upgrade as successful
			$this->htheme_mark_update_complete();
		}

		#MARK UPDATE COMPLETE
		private function htheme_mark_update_complete(){
			//access globals
			global $wpdb;
			//once updates are complete, mark the plugin version in the DB
			$wpdb->query($wpdb->prepare("UPDATE `". $wpdb->base_prefix ."htheme_root` SET `theme_version` = '". $this->theme_version ."' WHERE `theme_name` = %s;", $this->theme_name));
		}
		
	}