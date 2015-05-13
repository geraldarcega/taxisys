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
    public $tsdata;

	function __construct()
    {
        parent::__construct();

        $this->tsdata['user_data'] = getSession();
    }

    public function load_view( $views = '', $nav = true, $top_nav = true, $chat = true, $theme = 'default' )
    {
        $_view_folder = $this->router->fetch_class();
        
        $this->load->view( $theme.'/partials/header', $this->tsdata);
        if( $nav )
           $this->load->view( $theme.'/partials/navigation', $this->tsdata);

        if( $top_nav )
           $this->tsdata['top_nav'] = $this->load->view( $theme.'/partials/top_nav', $this->tsdata, true);

        if( $chat )
    	   $this->tsdata['chat'] = $this->load->view( $theme.'/partials/chat', $this->tsdata, true);

    	if( !empty( $views ) )
    	{
    		if( !is_array( $views ) )
    		{
    			$this->load->view( $_view_folder.'/'.$views, $this->tsdata );
    		}
    		else
    		{
	    		foreach ($views as $view)
	    		{
	    			$this->load->view( $_view_folder.'/'.$view, $this->tsdata );
	    		}
    		}
    	}
    	$this->load->view( $theme.'/partials/footer', $this->tsdata );
    }
}