<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Units extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('units_model');
    }

    public function index( )
    {
        $this->tsdata['nav']        = 'units';
        $this->tsdata['sub_nav']    = 'all_units';
        $this->tsdata['units']      = array();

        $this->load_view( 'all_units' );
    }

    public function ajax()
    {
        if( $this->input->is_ajax_request() )
        {
            switch ( $this->input->post( 'type' ) ) {
                case 'create':
                    
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        else
            redirect( dashboard_url(), '301' );
    }
}