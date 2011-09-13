<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Method exit status codes
|--------------------------------------------------------------------------
|
| These constants are used for unit testing.
*/
define("EXIT_SUCCESS", 0);
define("EXIT_ERROR_UNKNOWN", -1);
define("EXIT_ERROR_NO_SUCH_USER", -2);
define("EXIT_ERROR_ACCOUNT_INACTIVE", -3);
define("EXIT_ERROR_USER_NOT_LOGGED_IN", -4);
define("EXIT_ERROR_BAD_PASSWORD", -5);
define("EXIT_ERROR_NO_GROUP", -6);
define("EXIT_ERROR_USER_ALREADY_EXISTS", -7);
define("EXIT_ERROR_ACCESS_DENIED", -8);
define("EXIT_ERROR_VALIDATION_FAILURE", -9);
define("EXIT_ERROR_EMAIL_NOT_FOUND", -10);
define("EXIT_ERROR_EMAIL_NOT_SENT", -11);
define("EXIT_ERROR_DATA_NOT_FOUND", -12);
define("EXIT_ERROR_DATA_NOT_SAVED", -13);
define("EXIT_ERROR_DATABASE_ERROR", -14);
define("EXIT_ERROR_ILLEGAL_FILENAME", -15);
define("EXIT_ERROR_ILLEGAL_FILETYPE", -16);
define("EXIT_ERROR_FILE_UPLOAD_ERROR", -17);
define("EXIT_ERROR_CLEARING_SESSION", -18);
// end of unit-testing constants


/* End of file constants.php */
/* Location: ./application/config/constants.php */
