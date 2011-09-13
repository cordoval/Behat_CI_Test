<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_includes {
	//*********************************************************************
	//This Library contains user-created routines needed for systemwide use
	//*********************************************************************
	
	function generateRandStr($length)
	{
 		$randstr = "";

		for($i=0; $i<$length; $i++){
			$randnum = mt_rand(0,61);
			if($randnum < 10){
				$randstr .= chr($randnum+48);
			}
			else if($randnum < 36){
				$randstr .= chr($randnum+55);
			}
			else{
				$randstr .= chr($randnum+61);
			}
		}
		return $randstr;
	} 	
	
	function  generate_password() {
   	$length = 8;
    	$characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    	$string = "";    

    	for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    	}

    	return $string;
	}
	
	function escape_data($data)
	{
		//filters data from xss or sql injection hacks
		
		$data = trim(htmlentities(strip_tags($data)));	 
		if (get_magic_quotes_gpc()) $data = stripslashes($data);
		$newdata = mysql_real_escape_string($data); 
		return $newdata;
	}
	
	function display_message($type, $msg, $width = 300)
	{
		//Displays jquery-ui styled error message with rounded box.  User can send optional 3rd parm to set size
		
		if (trim($msg) == "") {
			return '';
		}

		$alertmsg = "";
		if ($type == 1) {
			$alertmsg = '<div class="ui-widget" style="width:'.$width.'px;">';
			$alertmsg .= '<div class="ui-state-error ui-corner-all" style="padding: 0.7em;">';
			$msg_array = explode("\n", $msg);
			foreach ( $msg_array as $msg ) {
				if ( trim($msg) != "" ) {
					$alertmsg .= '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>';
					$alertmsg .= $msg;
				}
			}
			$alertmsg .= '</div></div>';
		} else {
			$alertmsg .= '<div class="ui-widget" style="width:'.$width.'px;">';
			$alertmsg .= '<div class="ui-state-highlight ui-corner-all" style="padding: 0.7em;">';
			$msg_array = explode("\n", $msg);
			foreach ( $msg_array as $msg ) {
				if ( trim($msg) != "" ) {
					$alertmsg .= '<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>'; 
					$alertmsg .= $msg;
				}
			}
			$alertmsg .= '</div></div>';
		}
		
		return $alertmsg; 
	}
}
?>
