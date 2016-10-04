<?php
/**
 * THEME - InVogue
 * AUTHOR - HEROPLUGINS
 */

// HERO CHECK CLASS
class htheme_check{

	//string
	public function htheme_checkString($string){
		if(strlen($string) >= 1){
			return true;
		}
		return false;
	}

	//email
	public function htheme_checkEmail($string){
		if(preg_match('/.+@.+\.[a-z]/', $string)){
			return true;
		}
		return false;
	}

	//number
	public function htheme_checkNumber($string){
		if(is_numeric($string)){
			return true;
		}
		return false;
	}

	//contact number
	public function htheme_checkContactNumber($string){
		if(preg_match('/\d/', $string) && strlen($string) > 8){
			return true;
		}
		return false;
	}

	//date
	public function htheme_checkDate($string){
		if(strtotime($string) !== false){
			return true;
		}
		return false;
	}

}