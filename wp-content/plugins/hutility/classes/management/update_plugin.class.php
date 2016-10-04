<?php
	
	#UPDATE PLUGIN
	class hutility_update_plugin{
		
		#CLASS VARS
		private $plugin_name;
		private $plugin_version;
		private $plugin_old_version;
		private $plugin_dir;
		private $object_manager;
		
		#CONSTRUCT
		public function __construct($plugin_name,$plugin_version,$plugin_old_version,$plugin_dir){
			//set class vars
			$this->plugin_name = $plugin_name;
			$this->plugin_version = $plugin_version;
			$this->plugin_old_version = $plugin_old_version;
			$this->plugin_dir = $plugin_dir;
		}
		
		#TEARDOWN PLUGIN
		public function update_plugin(){
			//access globals
			global $wpdb;
			//update plugin tables
			/*
				-- update your plugin specific tables here --
				
				note: This should be version specific.				
			*/
			//mark the upgrade as successful
			$this->mark_update_complete();
		}
		
		#MARK UPDATE COMPLETE
		private function mark_update_complete(){
			//access globals
			global $wpdb;
			//once updates are complete, mark the plugin version in the DB
			$wpdb->query($wpdb->prepare("UPDATE `". $wpdb->base_prefix ."hplugin_root` SET `plugin_version` = '". $this->plugin_version ."' WHERE `plugin_name` = %s;", $this->plugin_name));
		}
		
	}