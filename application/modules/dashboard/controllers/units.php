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
        $filter = array();
        $sort = array();
        if($this->input->get('sort'))
            $sort = array( 'field' => $this->input->get('sort'), 'direction' => $this->input->get('sort_order') );

        $this->tsdata['nav']     = 'units';
        $this->tsdata['sub_nav'] = 'all_units';

        # Units data
        $units = $this->units_model->read( $filter, '*', null, null, $sort );

        $this->tsdata['units'] = $units;

        $this->load_view( 'all_units' );
    }

    public function ajax()
    {
        if( $this->input->is_ajax_request() )
        {
            switch ( $this->input->post( 'action' ) ) {
                case 'create':
                    $new = $this->units_model->create( $this->input->post() );
                    if( !is_array($new) )
                    {
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> New unit has been saved.');
                        $msg = array( 'success' => 1 );
                    }
                    else
                    {
                        if( isset($new['exist']) )
                            $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> Unit with plate #'.$new['exist'].' is already exists.' );
                        else
                            $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Urgent!</strong> Please contact the administrator immediately' );
                    }

                    echo json_encode( $msg );
                    break;
                case 'update':
                    $update = $this->units_model->update( $this->input->post() );
                    if( $update )
                    {
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> Unit has been updated.');
                        $msg = array( 'success' => 1 );
                    }
                    else
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Failed!</strong> Please contact the administrator immediately' );

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