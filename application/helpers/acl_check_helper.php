<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
if ( ! function_exists('acl_check'))
{
        function acl_check($uri = '', $user_gids = '')
        {
                $sql = "SELECT uri, groups FROM acls WHERE uri = ?";
                $qret = $this->dbr->query($sql, $uri);
                if ($qret->num_rows() <= 0) {
                        return TRUE;
                }
                $row = $this->dbr->row();
                $acl_gids = $row->groups;
                $qret->free_result();

                $user_gids_array = explode(',', $user_gids);

                $tok = strtok($acl_gids, ';');
                while ( $tok !== FALSE ) {
                        $acl_gids_array = explode(',', $tok);
                        $result = array_diff($acl_gids_array, $user_gids_array);
                        if ( empty($result) ) {
                                return TRUE;
                        }
                        $tok = strtok(';');
                }
                return FALSE;
        }
}
*/

if ( ! function_exists('getCurrPath'))
{
	function getCurrPath()
	{
		$CI =& get_instance();

		if ( isset($CI->debug) and isset($CI->debug_file) ) {
			$CI->debug_log->write('function getCurrPath():', $CI->debug, $CI->debug_file);
		}

    /*
     * DPW: The following URI checks are for the testing environment.
     */
		if ( isset($CI->debug) and isset($CI->debug_file) ) {
			$CI->debug_log->write('getCurrPath(): checking $CI->uri->uri_string = ' . print_r($CI->uri->uri_string, 1), $CI->debug, $CI->debug_file);
			$CI->debug_log->write('getCurrPath(): checking $CI->uri->segments = ' . print_r($CI->uri->segments, 1), $CI->debug, $CI->debug_file);
			$CI->debug_log->write('getCurrPath(): checking $CI->uri->rsegments = ' . print_r($CI->uri->rsegments, 1), $CI->debug, $CI->debug_file);
		}
    if ( $CI->uri->uri_string == '' ) {
      $CI->uri->uri_string = $_SERVER['REQUEST_URI'];
			if ( isset($CI->debug) and isset($CI->debug_file) ) {
				$CI->debug_log->write('getCurrPath(): uri->uri_string was empty. fetched = ' . $CI->uri->uri_string, $CI->debug, $CI->debug_file);
			}
    }
		else {
			if ( isset($CI->debug) and isset($CI->debug_file) ) {
				$CI->debug_log->write('getCurrPath(): uri->uri_string = ' . $CI->uri->uri_string, $CI->debug, $CI->debug_file);
			}
		}

    if ( empty($CI->uri->segments) ) {
			if ( isset($CI->debug) and isset($CI->debug_file) ) {
				$CI->debug_log->write('getCurrPath(): uri->segments is empty. fixing...', $CI->debug, $CI->debug_file);
			}
      // DPW: because the URI segments array starts at index 1, we do the following...
      $ndx =1;
      foreach (explode('/', $_SERVER['REQUEST_URI']) as $value) {
        if ( $value == '' ) continue;
				if ( isset($CI->debug) and isset($CI->debug_file) ) {
					$CI->debug_log->write("getCurrPath(): adding uri->segment[$ndx] = $value", $CI->debug, $CI->debug_file);
 	       	$CI->uri->segments[$ndx] = trim($value);
				}
        $ndx++;
      }
			if ( isset($CI->debug) and isset($CI->debug_file) ) {
				$CI->debug_log->write('getCurrPath(): $CI->uri->segments = ' . print_r($CI->uri->segments, 1), $CI->debug, $CI->debug_file);
			}
    }
		else {
			if ( isset($CI->debug) and isset($CI->debug_file) ) {
				$CI->debug_log->write('getCurrPath(): uri->segments = ' . print_r($CI->uri->segments, 1), $CI->debug, $CI->debug_file);
			}
		}

    if ( empty($CI->uri->rsegments) ) {
      $CI->uri->rsegments = array_reverse($CI->uri->segments);
			if ( isset($CI->debug) and isset($CI->debug_file) ) {
				$CI->debug_log->write('getCurrPath(): uri->rsegments is empty. fixing...', $CI->debug, $CI->debug_file);
				$CI->debug_log->write('getCurrPath(): $CI->uri->rsegments = ' . print_r($CI->uri->rsegments, 1), $CI->debug, $CI->debug_file);
			}
    }
    // DPW: end of URI checks are for the testing environment.

		$request_url = $CI->uri->segment(1) != "" ? $CI->uri->segment(1) : "/";
		$request_url = $CI->uri->segment(2) != "" ? $request_url."/".$CI->uri->segment(2) : $request_url;

		if ( isset($CI->debug) and isset($CI->debug_file) ) {
			$CI->debug_log->write('getCurrPath(): returning $request_url = >' . print_r($request_url, 1) . '<', $CI->debug, $CI->debug_file);
		}

		return $request_url;
	}
}

if ( ! function_exists('getACLData'))
{
	function getACLData()
	{
		$CI =& get_instance();		

		$sql = "SELECT uri, groups FROM acls ORDER BY uri";	
		$qret = $CI->db->query($sql);
		if ($qret->num_rows() > 0) {
			foreach ($qret->result() as $row) {
	     		$data[] = $row;				
	    	}			
			$qret->free_result();
			return $data;
		} else {		
			return FALSE;
		}	
	}
}

if ( ! function_exists('get_acl_redirect'))
{	
	function get_acl_redirect($request_url) 
	{
		$CI =& get_instance();		
		$sql = "SELECT redirect FROM acls WHERE uri = '".$request_url."'";	
		$qret = $CI->db->query($sql);
		if ($qret->num_rows() > 0) {
			foreach ($qret->result() as $row) {
	     		$data = $row->redirect;				
	    	}			
			$qret->free_result();
			return $data;
		} else {		
			return FALSE;
		}		
	}
}

if ( ! function_exists('acl_check'))
{
	function acl_check($view, $uri_data = NULL)
	{
		$CI =& get_instance();	

		if ( isset($CI->debug) and isset($CI->debug_file) ) {
			$CI->debug_log->write('acl_check(): checking $view = >' . print_r($view, 1) . '<', $CI->debug, $CI->debug_file);
		}

		//This boolean-returned function will check user against table-based access definitions when view request is made.
		//
		//Function will return TRUE if user has access rights to the page view
		//Function will return FALSE is user's groups are not found or that the access level is not sufficient for access
		//******************
	
		$ret_value = 0;		
		
		if ($CI->config->item('uri_list')) {
			$uri_data = $CI->config->item('uri_list');
		} else { 
			error_log("Config File config_custom.php Not Found!");  
			if ( isset($CI->debug) and isset($CI->debug_file) ) {
				$CI->debug_log->write('acl_check(): Config File config_custom.php Not Found!', $CI->debug, $CI->debug_file);
			}
		}		

		if ( isset($CI->debug) and isset($CI->debug_file) ) {
			$CI->debug_log->write('acl_check(): checking $uri_data = >' . print_r($uri_data, 1) . '<', $CI->debug, $CI->debug_file);
		}
		
		if (isset($uri_data)) {
			//NEW VERSION HERE!!  MAKES USE OF THE CONFIG CUSTOM VAR FOR URI ACCESS

			//get all current groups user is assigned and put into array	
			$curr_groups = explode(",", $CI->session->userdata('groups'));
			if ( isset($CI->debug) and isset($CI->debug_file) ) {
				$CI->debug_log->write('acl_check(): $curr_groups = >' . print_r($curr_groups, 1) . '<', $CI->debug, $CI->debug_file);
			}
		
			foreach ($uri_data as $acldata) {
				$acl_uri = $acldata['uri'];
				if ( isset($CI->debug) and isset($CI->debug_file) ) {
					$CI->debug_log->write('acl_check(): $acl_uri = >' . print_r($acl_uri, 1) . '<', $CI->debug, $CI->debug_file);
				}

				$acl_groups = $acldata['groups'];

				if ($view === $acl_uri) {
					if ( isset($CI->debug) and isset($CI->debug_file) ) {
						$CI->debug_log->write('acl_check(): matched view and $acl_uri = >' . print_r($acl_uri, 1) . '<', $CI->debug, $CI->debug_file);
					}
					
					if (strpos($acl_groups, 'ALL') !== FALSE) {
						if ( isset($CI->debug) and isset($CI->debug_file) ) {
							$CI->debug_log->write('acl_check(): matched acl group = >ALL<', $CI->debug, $CI->debug_file);
							$CI->debug_log->write('acl_check(): returning $ret_value = >' . print_r(TRUE, 1) . '<', $CI->debug, $CI->debug_file);
						}
						return TRUE;
					}
					
					$group_list = explode(";", $acl_groups);
	
					foreach ($group_list as $key=>$value) {
						$acl_sublist = explode(",", $value);
						
						foreach($acl_sublist as $key=>$a_data) {
							//echo "<br>DIR=$view ARR_SEARCH=array_search($a_data, "; print_r($curr_groups); echo " IN_ARRAY=".in_array($a_data, $curr_groups); echo "<br>";
							if (in_array($a_data, $curr_groups)) {
								$ret_value = 1;
								if ( isset($CI->debug) and isset($CI->debug_file) ) {
									$CI->debug_log->write("acl_check(): matched acl group = >$a_data<", $CI->debug, $CI->debug_file);
								}
								break;
							}
						}					
						if ($ret_value == 1) break;					
					}				
				}			
				if ($ret_value == 1) break;			
			}
			
		} else {	
			//ORIGINAL VERSION HERE!!
			
			//retrieve all ACLS data 		
			$acl_data = array();
			$acl_data = getACLData();
			$CI->session->set_userdata('acl', $acl_data);
			
			//get all current groups user is assigned and put into array	
			$curr_groups = explode(",", $CI->session->userdata('groups'));
			
			//get all acl/directory combos to search on	
			$acl_all = $CI->session->userdata('acl');
			
			foreach ($acl_all as $acldata) {
				$acl_uri = $acldata->uri;
				$acl_groups = $acldata->groups;
				
				if ($view === $acl_uri) {
					
					if (strpos($acl_groups, 'ALL') !== FALSE) {
						return TRUE;
					}
					
					$group_list = explode(";", $acl_groups);
					foreach ($group_list as $key=>$value) {
						$acl_sublist = explode(",", $value);
						
						foreach($acl_sublist as $key=>$a_data) {
							//echo "DIR=$view ARR_SEARCH=array_search($a_data, "; print_r($curr_groups); echo " IN_ARRAY=".in_array($a_data, $curr_groups); echo "<br>";
							if (in_array($a_data, $curr_groups)) {
								$ret_value = 1;
							} else {
								$ret_value = 0;
								break;	
							}
						}					
						if ($ret_value == 1) break;					
					}				
				}			
				if ($ret_value == 1) break;			
			}
			
		}
		
		if ( isset($CI->debug) and isset($CI->debug_file) ) {
			$CI->debug_log->write('acl_check(): returning $ret_value = >' . print_r($ret_value, 1) . '<', $CI->debug, $CI->debug_file);
		}

		if ($ret_value == 1) {
			return TRUE; 
		} else {
			return FALSE;				
		}
	}
}

if ( ! function_exists('authorize'))
{
	function authorized()
	{
		$CI =& get_instance();	

		if ( isset($CI->debug) and isset($CI->debug_file) ) {
			$CI->debug_log->write('helper function authorized():', $CI->debug, $CI->debug_file);
			$CI->debug_log->write('checking session  user_id = >' . print_r($CI->session->userdata, 1) . '<', $CI->debug, $CI->debug_file);
		}

		if ( $CI->session->userdata('user_id') == "" ) {
			$return_value = 0;
		}
		else {
			$pathinfo = getCurrPath();
			if ( isset($CI->debug) and isset($CI->debug_file) ) {
				$CI->debug_log->write('authorized(): pathinfo = >' . print_r($pathinfo, 1) . '<', $CI->debug, $CI->debug_file);
			}
			if ( acl_check($pathinfo) ) {
				$return_value = 1;
			}
			else {
				$return_value = -1;
			}
		}

		if ( isset($CI->debug) and isset($CI->debug_file) ) {
			$CI->debug_log->write('authorized(): returning return_value = >' . print_r($return_value, 1) . '<', $CI->debug, $CI->debug_file);
		}

		return $return_value;				
	}
}

?>
