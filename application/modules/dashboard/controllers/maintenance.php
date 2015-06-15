<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Maintenance extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('maintenance_model');
    }

    public function index( )
    {
        $this->tsdata['nav']        = 'maintenance';
        $this->tsdata['sub_nav']    = 'index';
        $this->tsdata['boundary']   = array();

        $this->load_view( 'index' );
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