<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Debug_log {

	public function write($message=NULL, $debug=0, $log_name=NULL)
	{
		if ( $debug === TRUE ) {
			$log_dir = getcwd() . "/application/logs/";
			$logfile = ($log_name == NULL) ? $log_dir . '/debug.log' : $log_dir . $log_name . '.log';

			@chmod($logfile, 0666);

			if ( ! preg_match("/^.*?\n$/", $message) ) {
				$message .= "\n";
			}
			$date = date("D, d M Y, H:i:s");
			$bt = debug_backtrace();
			$controller = basename($bt[0]['file']);
			$line_number = $bt[0]['line'];
			$message = $date . ", Controller: $controller, Line: $line_number: " . $message;
			error_log(print_r($message, 1), 3, $logfile);
		}
	}
}

/* End of file Someclass.php */
