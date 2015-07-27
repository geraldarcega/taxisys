<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* load the MX_Loader class */
require APPPATH."third_party/MX/Controller.php";

class MY_Controller extends MX_Controller {
	function __construct()
    {
        parent::__construct();
    }
}

class MY_Framework extends MY_Controller {
    public $data;
    public $_class;
    public $_method;
    public $userdata;
    public $top_nav = true;

	function __construct()
    {
        parent::__construct();

        $this->userdata = getSession();

        $this->_class = $this->router->fetch_class();
        $this->_method = $this->router->fetch_method();

        $this->load->library('frontend_library', array( 'class' => $this->_class, 'method' => $this->_method ) );
    }

    public function load_view( $views = '', $nav = true, $chat = false, $theme = 'default' )
    {
        $_view_folder = $this->_class;

        # Assets
        $this->data['css'] = $this->frontend_library->load_css( );
        $this->data['js']  = $this->frontend_library->load_js( );
        
        $this->load->view( $theme.'/partials/header', $this->data);
        if( $nav )
            $this->load->view( $theme.'/partials/navigation', $this->data);

        $this->load->view( $theme.'/partials/top_nav', $this->data);

        if( $chat )
    	   $this->data['chat'] = $this->load->view( $theme.'/partials/chat', $this->data, true);

    	if( !empty( $views ) )
    	{
    		if( !is_array( $views ) )
    		{
    			$this->load->view( $_view_folder.'/'.$views, $this->data );
    		}
    		else
    		{
	    		foreach ($views as $view)
	    		{
	    			$this->load->view( $_view_folder.'/'.$view, $this->data );
	    		}
    		}
    	}
    	$this->load->view( $theme.'/partials/footer', $this->data );
    }
}