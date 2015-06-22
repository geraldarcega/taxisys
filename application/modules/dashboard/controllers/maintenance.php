<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Maintenance extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('maintenance_model');
        $this->load->model('parts_model');
    }

    public function index( )
    {
        $this->tsdata['maintenance'] = $this->maintenance_model->read();
        $parts = $this->parts_model->read( array( 'wh|stock >' => 0 ) );
        if( $parts->num_rows() > 0 )
        {
            $_parts = array();
            foreach ($parts->result() as $part) {
                $_parts[ $part->parts_id ] = $part;
            }
            $this->tsdata['parts'] = json_encode($_parts);
        }

        $this->load_view( 'index' );
    }

    public function unscheduled( )
    {
        $this->tsdata['sub_nav']    = $this->_method;
        $this->tsdata['boundary']   = array();

        $this->load_view( 'index' );
    }

    public function ajax()
    {
        if( $this->input->is_ajax_request() )
        {
            switch ( $this->input->post( 'action' ) ) {
                case 'create':
                    $new = $this->maintenance_model->create( $this->input->post() );
                    if( !isset( $new['exists'] ) )
                    {
                        $parts = $this->input->post('parts');
                        $parts_count = $this->input->post('parts_count');
                        if( is_array($parts) )
                        {
                            for ($i=0; $i < count($parts); $i++) { 
                                
                            }
                        }
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> New mainetenance has been created.');
                        $msg = array( 'success' => 1 );
                    }
                    else
                    {
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Failed!</strong> '.$this->input->post('m_type').' is already exists.' );
                    }

                    echo json_encode( $msg );
                    break;
                
                case 'update':
                    $new = $this->maintenance_model->update( $this->input->post() );
                    if( $new )
                    {
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> Mainetenance details has been updated.');
                        $msg = array( 'success' => 1 );
                    }
                    else
                    {
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> There\s something wrong.' );
                    }

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