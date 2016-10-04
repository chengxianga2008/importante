<?php

	#UNINSTALL PLUGIN
	if(!defined('WP_UNINSTALL_PLUGIN')){
		exit();
	}
	
	//access globals
	global $wpdb;
	
	//flag deleted
	$wpdb->query($wpdb->prepare("UPDATE `". $wpdb->base_prefix ."hplugin_root` SET `deleted` = 1 WHERE `plugin_name` = %s;", 'hplugin')); //flag deleted
	
	//clean up
	$wpdb->query("DROP TABLE IF EXISTS `". $wpdb->base_prefix ."hutility_default_storage_table`;"); //default storage table