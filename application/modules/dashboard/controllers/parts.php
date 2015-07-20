<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parts extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('parts_model');
        $this->load->model('units_model');
    }

    public function index( )
    {
        $this->data['parts'] = $this->parts_model->read();

        $this->load_view( 'index' );
    }

    public function ajax()
    {
        if( $this->input->is_ajax_request() )
        {
            switch ( $this->input->post( 'action' ) ) {
                case 'create':
                    $new = $this->parts_model->create( $this->input->post() );
                    if( !isset($new['exist']) )
                    {
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> New parts has been added.');
                        $msg = array( 'success' => 1 );
                    }
                    else
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> Driver '.$this->input->post('name').' is already exists.' );

                    echo json_encode( $msg );
                    break;
                case 'update':
                    $new = $this->parts_model->update( $this->input->post() );
                    if( !isset($new['exist']) )
                    {
                        $this->units_model->create_log( array( 'unit_idFK' => $this->input->post('unit'), 'driver_idFK' => $this->input->post('driver_id') ) );
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> Driver\'s details is now updated.');
                        $msg = array( 'success' => 1 );
                    }
                    else
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> Driver '.$this->input->post('fname').' '.$this->input->post('lname').' is already exists.' );

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