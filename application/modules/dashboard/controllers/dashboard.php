<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
    }

    public function login( )
    {
        if( $this->tsdata['user_data'] )
            redirect( dashboard_url() );

        if( $this->input->post() )
        {
            $this->load->model('users_model');
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

        redirect( dashboard_url( 'login' ) );
    }

    # dashboard units
    public function index( )
    {
        $this->tsdata['nav']        = 'dashboard';
        $this->tsdata['sub_nav']    = 'units';
        $this->load_view( 'dashboard' );
    }

    public function drivers( )
    {
        $this->tsdata['nav']        = 'dashboard';
        $this->tsdata['sub_nav']    = 'drivers';
        $this->load_view( 'drivers' );
    }

}