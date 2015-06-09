<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Drivers extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('drivers_model');
        $this->load->model('units_model');
    }

    public function index( )
    {
        $this->tsdata['nav']         = 'drivers';
        $this->tsdata['drivers']     = $this->drivers_model->read();
        $this->tsdata['avail_units'] = $this->units_model->read();

        $this->load_view( 'index', true );
    }

    public function ajax()
    {
        if( $this->input->is_ajax_request() )
        {
            switch ( $this->input->post( 'action' ) ) {
                case 'create':
                    $new = $this->drivers_model->create( $this->input->post() );
                    if( !isset($new['exist']) )
                    {
                        $this->units_model->create_log( array( 'unit_idFK' => $this->input->post('unit'), 'driver_idFK' => $new ) );
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> New driver has been created.');
                        $msg = array( 'success' => 1 );
                    }
                    else
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> Driver '.$this->input->post('fname').' '.$this->input->post('lname').' is already exists.' );

                    echo json_encode( $msg );
                    break;
                case 'update':
                    $new = $this->drivers_model->update( $this->input->post() );
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