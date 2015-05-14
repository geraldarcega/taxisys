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
| Paths
|--------------------------------------------------------------------------
|
| User-defined
|
*/

define('PROTOCOL', (isset($_SERVER['HTTPS'])) ? 'https://' : 'http://');
define('SITE_URL', PROTOCOL.$_SERVER['HTTP_HOST'].'/');
define('JS_DIR', SITE_URL.'assets/js/');
define('CKEDITOR_DIR', SITE_URL.'assets/ckeditor/');

define('CSS_DIR', SITE_URL.'assets/css/');
define('IMAGE_DIR', SITE_URL.'assets/img/');
define('FONT_DIR', SITE_URL.'assets/fonts/');

/*
|--------------------------------------------------------------------------
| Status
|--------------------------------------------------------------------------
|
| User-defined
|
*/

define('ONDUTY', 1);
define('ONGARRAGE', 2);
define('ONMAINTENANCE', 3);
define('REPLACED', 4);

define('MON', 1);
define('TUE', 2);
define('WED', 3);
define('THUR', 4);
define('FRI', 5);
define('SAT', 6);
define('SUN', 7);

/* End of file constants.php */
/* Location: ./application/config/constants.php */