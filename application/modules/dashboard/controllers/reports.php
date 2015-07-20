<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
        // $this->load->model('units_model');
    }

    public function boundary( )
    {
        $this->data['sub_nav']    = 'boundary';
        $this->data['boundary']   = array();

        $this->load_view( 'boundary' );
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