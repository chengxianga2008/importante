<?php
/*
	Plugin Name: Hero Utility Plugin
	Plugin URI: http://www.heroplugins.com
	Description: Utility plugin for HeroPlugin themes.
	Version: 0.1.4
	Author: Hero Plugins
	Author URI: http://www.heroplugins.com
	License: GPLv2 or later
*/

#LICENSE INFORMATION
/*
	Copyright 2015  Hero Plugins (email : info@heroplugins.com)

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

	#SHORTCODES
	require_once('classes/management/shortcodes.php');
	
	#PLUGIN INCLUDES
	require_once('classes/helper/check.helper.php');
	require_once('classes/management/activate_plugin.class.php');
	require_once('classes/management/update_plugin.class.php');
	require_once('classes/management/deactivate_plugin.class.php');
	require_once('classes/core/checkin.class.php');
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	#POST TYPES
	include('posttypes/htheme.posttype.people.php');
	include('posttypes/htheme.posttype.faq.php');
	include('posttypes/htheme.posttype.signup.php');
	include('posttypes/htheme.posttype.lookbooks.php');
	include('posttypes/htheme.posttype.testimonial.php');
	
	#DEFINE HELPER CLASS POINTER
	$hutility_helper;
	
	#PLUGIN ROOT
	class heroplugin_hutility{

		#PLUGIN CONFIG
		private $plugin_name = 'hutility';
		private $plugin_friendly_name = 'Hero Utility Plugin';
		private $plugin_friendly_description = 'Utility plugin for HeroPlugin themes.';
		private $plugin_version = '0.1.4';
		private $plugin_prefix = 'hutility_';
		private $first_release = '2016-06-27';
		private $last_update = '2016-08-16';
		private $api_version = '2.0.1';
		
		#CLASS VARS
		private $plugin_dir;
		private $plugin_url;
		private $plugin_basename;
		private $plugin_old_version;
		private $plugin_uuid;

		#CONSTRUCT
		public function __construct(){

			//define plugin vars
			$this->plugin_dir = dirname(__FILE__);
			$this->plugin_basename = plugin_basename(__FILE__);
			$this->plugin_url = plugins_url($this->plugin_name) .'/';
			
			//instantiate helper class
			global $hutility_helper;
			$hutility_helper = new hutility_helper($this->plugin_prefix);
			
			//register management hooks
			register_activation_hook(__FILE__,array(new hutility_activate($this->plugin_name, $this->plugin_version, $this->plugin_dir), 'setup_plugin')); //activate
			register_deactivation_hook(__FILE__,array(new hutility_deactivate($this->plugin_name), 'teardown_plugin')); //deactivate
			
			//detect if update required
			global $wpdb;
			if($this->plugin_old_version == NULL && $hutility_helper->onAdmin()){ //only make the DB call if required
				$plugin_lookup = $wpdb->get_results($wpdb->prepare("SELECT * FROM `". $wpdb->base_prefix ."hplugin_root` WHERE `plugin_name` = %s;", $this->plugin_name));
				if($plugin_lookup){
					$this->plugin_old_version = $plugin_lookup[0]->plugin_version;
					$this->plugin_uuid = $plugin_lookup[0]->plugin_uuid; //define plugin uuid for check-in
				}
				if(version_compare($this->plugin_old_version,$this->plugin_version,'<')){
					$update = new hutility_update_plugin($this->plugin_name,$this->plugin_version,$this->plugin_old_version, $this->plugin_dir);
					$update->update_plugin();
				}
			}

			//queue update check
			$checkin = new hutility_checkin($this->plugin_basename,$this->plugin_name,$this->plugin_friendly_name,$this->api_version);
			add_filter('pre_set_site_transient_update_plugins', array(&$checkin, 'check_in'));
			
		}
		
	}

	#SHORCODES
	function shortcodes(){
		new hutility_shortcodes();
	}

	add_action( 'vc_before_init', 'shortcodes', 0 );
	
	#INITIALISE THE PLUGIN CODE WHEN WP INITIALISES
	new heroplugin_hutility();