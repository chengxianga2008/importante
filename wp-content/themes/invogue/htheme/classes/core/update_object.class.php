<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

#PLUGIN AUTO-GENERATION MANAGEMENT
class htheme_update_object{

	#CLASS VARS
	private $plugin_dir;
	private $options;

	#CONSTRUCT
	public function __construct(){
		$this->options = new htheme_options();
	}

	#UPDATE 'ACTIVE' OBJECTS IN DB
	public function htheme_update_database_objects(){

		#GET DEFAULT OBJECT
		$default_object = $this->options->htheme_add_default_options();

		#GLOBALS
		global $wpdb;

		#GET CURRENT OBJECT IN DB
		$options = get_option( 'hero_theme_options' );

		#CONVERT STRING BACK TO ARRAY
		$current_object = unserialize($options);

		#COMPARE CURRENT OBJECT WITH DEFAULT OBJECT AND ADD MISSING VALUES
		$new_object = $this->htheme_array_merge_recursive_distinct($default_object, $current_object);

		#SERIALIZE
		$serialize = serialize($new_object);

		#UPDATE OPTION
		update_option( 'hero_theme_options', $serialize );

	}

	#RECURSIVELY MERGE 2 ARRAYS
	private function htheme_array_merge_recursive_distinct(array &$array1, array &$array2){
		$merged = $array1;
		foreach($array2 as $key => &$value){
			if($key == 'slides'){ //slight modification to ignore slides
				if(count($value) == 0){
					$merged[$key] = array();
				}else{
					$merged[$key] = $value;
				}
			}else{
				if(is_array($value) && isset($merged[$key]) && is_array($merged[$key])){
					$merged[$key] = $this->htheme_array_merge_recursive_distinct($merged[$key], $value);
				}else{
					if(isset($array1[$key])){
						$merged[$key] = $value;
					}
				}
			}
		}
		return $merged;
	}

}