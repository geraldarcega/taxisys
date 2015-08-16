<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Frontend_library
{
	protected $CI;
	public $_class;
    public $_method;

	function __construct( $params )
	{
		$this->CI =& get_instance();

		$this->_class  = $params['class'];
		$this->_method = $params['method'];
	}

	public function load_css( )
	{
		$css[] = CSS_DIR.'bootstrap.min.css';
		$css[] = CSS_DIR.'sb-admin-2.css';
		$css[] = '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css';

		if( $this->_class == 'calendar' )
		{
			$css[] = '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.css';

			$class_css = 'assets/css/'.$this->_class.'.css';
			if( file_exists($class_css) )
				$css[] = CSS_DIR.$this->_class.'.css';
		}

		if( $this->_method != 'login' )
		{
			$css[] = CSS_DIR.'plugins/metisMenu/metisMenu.min.css';
			$css[] = CSS_DIR.'bootstrap-datetimepicker.css';
			$css[] = CSS_DIR.'bootstrap-switch.min.css';
			$css[] = CSS_DIR.'tablesorter.css';
			$css[] = CSS_DIR.'bootstrap-multiselect.css';
		}

		return $this->_process($css, 'css');
	}

	public function load_js( )
	{
		$js[] = JS_DIR.'jquery-2.1.3.min.js';
		$js[] = JS_DIR.'bootstrap.min.js';
		$js[] = JS_DIR.'angular.min.js';
		$js[] = JS_DIR.'controller.js';
		$js[] = JS_DIR.'jquery.validate.min.js';
		$js[] = JS_DIR.'jquery-validate.bootstrap-tooltip.js';

		if( $this->_method == 'login' )
			$js[] = JS_DIR.'users.js';
		else
		{
			$js[] = JS_DIR.'plugins/metisMenu/metisMenu.min.js';
			$js[] = '//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js';
			$js[] = JS_DIR.'bootstrap-datetimepicker.js';
			$js[] = JS_DIR.'bootstrap-switch.min.js';
			$js[] = JS_DIR.'jquery.tablesorter.min.js';
			// $js[] = JS_DIR.'bootstrap-multiselect.js';

			if( $this->_class == 'calendar' )
				$js[] = '//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.js';

			$class_js = 'assets/js/'.$this->_class.'.js';
			if( file_exists($class_js) )
				$js[] = JS_DIR.$this->_class.'.js';
			
			$js[] = JS_DIR.'sb-admin-2.js';
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