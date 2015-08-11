<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administrator extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('garage_model');
    }

    public function garage( )
    {
        $this->data['sub_nav'] = 'garage';
        $this->data['garage'] = $this->garage_model->read();

        $this->load_view( 'garage' );
    }

    public function settings( )
    {
        $this->data['sub_nav'] = 'garage';
        $this->data['garage'] = $this->garage_model->read();

        $this->load_view( 'garage' );
    }

    public function ajax()
    {
        if( $this->input->is_ajax_request() )
        {
            switch ( $this->input->post( 'action' ) ) {
                case 'create':
                    if( $this->garage_model->create( $this->input->post() ) )
                    {
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> New garage has been created.');
                        $msg = array( 'success' => 1 );
                    }
                    else
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> Something went wrong.' );

                    echo json_encode( $msg );
                    break;
                
                case 'update':
                    if( $this->garage_model->update( $this->input->post() ) )
                    {
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> Garage details has been updated.');
                        $msg = array( 'success' => 1 );
                    }
                    else
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> Something went wrong.' );

                    echo json_encode( $msg );
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