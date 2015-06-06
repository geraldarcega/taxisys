<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Frontend_library
{
	protected $CI;

	function __construct()
	{
		$this->CI =& get_instance();
	}

	public function load_css( $class, $method )
	{
		$css[] = CSS_DIR.'bootstrap.min.css';
		$css[] = CSS_DIR.'sb-admin-2.css';
		$css[] = '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css';

		if( $class == 'calendar' )
		{
			$css[] = '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.css';

			$class_css = 'assets/css/'.$class.'.css';
			if( file_exists($class_css) )
				$css[] = CSS_DIR.$class.'.css';
		}

		if( $method != 'login' )
		{
			$css[] = CSS_DIR.'plugins/metisMenu/metisMenu.min.css';
			$css[] = CSS_DIR.'bootstrap-datetimepicker.css';
			$css[] = CSS_DIR.'bootstrap-switch.min.css';
			$css[] = CSS_DIR.'tablesorter.css';
		}


		return $this->_process($css, 'css');
	}

	public function load_js( $class, $method )
	{
		$js[] = JS_DIR.'jquery-2.1.3.min.js';
		$js[] = JS_DIR.'bootstrap.min.js';
		$js[] = JS_DIR.'jquery.validate.min.js';
		$js[] = JS_DIR.'jquery-validate.bootstrap-tooltip.js';

		if( $method == 'login' )
			$js[] = JS_DIR.'users.js';
		else
		{
			$js[] = JS_DIR.'plugins/metisMenu/metisMenu.min.js';
			$js[] = '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js';
			$js[] = JS_DIR.'bootstrap-datetimepicker.js';
			$js[] = JS_DIR.'bootstrap-switch.min.js';
			$js[] = JS_DIR.'jquery.tablesorter.min.js';
			$js[] = JS_DIR.'sb-admin-2.js';

			if( $class == 'calendar' )
				$js[] = '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.js';

			$class_js = 'assets/js/'.$class.'.js';
			if( file_exists($class_js) )
				$js[] = JS_DIR.$class.'.js';
		}

		return $this->_process( $js, 'js' );
	}

	private function _process( $assets, $type )
	{
		$_assets = '';
		for ($i=0; $i < count($assets); $i++) {
			if( $type == 'css' )
				$_assets .= '<link href="'.$assets[$i].'" rel="stylesheet">';
			else
				$_assets .= '<script src="'.$assets[$i].'" type="text/javascript"></script>';				
		}
		return $_assets;
	}
}
?>