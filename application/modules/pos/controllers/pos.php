<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pos extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
    }

    public function login( )
    {
        if( $this->tsdata['user_data'] )
            redirect( pos_url() );

        if( $this->input->post() )
        {
            $this->load->model('dashboard/users_model');
            $check = $this->users_model->read( 
                        array( 
                                 'wh|username' => $this->input->post('username')
                                ,'wh|pword' => md5($this->input->post('password'))
                            )
                    );
            if( $check->num_rows() )
            {
                $this->session->set_userdata( 'user_info', $check->row() );
                $msg = array( 'success' => true );
            }
            else
                $msg = array( 'success' => false );

            echo json_encode( $msg );
        }
        else
            $this->load_view( 'login', false, false );
    }

    public function logout( )
    {
        $this->session->sess_destroy();

        redirect( pos_url( 'login' ) );
    }

    # dashboard units
    public function index( )
    {
        $this->load->model('dashboard/units_model');
        $now = date('Y-m-d');

        $this->tsdata['nav']        = 'pos';
        $this->tsdata['sub_nav']    = 'units';

        $this->tsdata['units']['on_duty']        = $this->units_model->read( array( 'wh|status' => ONDUTY ), '*' );
        $this->tsdata['units']['on_garrage']     = $this->units_model->read( array( 'wh|status' => ONGARRAGE ), '*' );
        $this->tsdata['units']['on_maintenance'] = $this->units_model->read( array( 'wh|status' => ONMAINTENANCE ), '*' );

        $this->load_view( 'units' );
    }

    public function drivers( )
    {
        $this->tsdata['nav']        = 'pos';
        $this->tsdata['sub_nav']    = 'drivers';
        $this->load_view( 'drivers' );
    }

}