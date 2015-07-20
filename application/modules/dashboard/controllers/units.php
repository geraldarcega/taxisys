<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Units extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('units_model');
        $this->load->model('maintenance_model');
    }

    public function index( )
    {
        $filter = array();
        $sort = array();
        if($this->input->get('sort'))
            $sort = array( 'field' => $this->input->get('sort'), 'direction' => $this->input->get('sort_order') );

        # Units data
        $this->data['units'] = $this->units_model->read( $filter, null, null, $sort );

        $this->load_view( 'all_units' );
    }

    public function maintenance( $type, $unit_id )
    {
        if( ($type == '' && ($unit_id == '' || !is_numeric($unit_id))) )
            redirect( dashboard_url('units') );

        # Unit data
        $unit = $this->units_model->read( array( 'wh|u.id' => $unit_id ) );
        if( !$unit->num_rows() )
            redirect( dashboard_url('units') );

        $this->data['unit']    = $unit->row();
        $this->data['sub_nav'] = $type.' maintenance ('.strtoupper($this->data['unit']->plate_number).')';

        $maintenance = $this->maintenance_model->read();
        if( $maintenance->num_rows() > 0 )
        {
            $_maintenance = array();
            foreach ($maintenance->result() as $m) {
                $_maintenance[ $m->id ] = $m;
            }
            $this->data['maintenance'] = json_encode($_maintenance);
        }
        $this->load_view( 'maintenance' );
    }

    public function ajax()
    {
        if( $this->input->is_ajax_request() )
        {
            $action = $this->input->post( 'action' ) != '' ? $this->input->post( 'action' ) : $this->input->get( 'action' );
            switch ( $action ) {
                case 'create':
                    $new = $this->units_model->create( $this->input->post() );
                    if( !is_array($new) )
                    {
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> New unit has been created.');
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
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> Unit\'s details has been updated.');
                        $msg = array( 'success' => 1 );
                    }
                    else
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Failed!</strong> Please contact the administrator immediately' );

                    echo json_encode( $msg );
                    break;
                
                case 'get_parts':
                    $parts = $this->maintenance_model->get_maintenance_parts( array( 'wh|maintenance_id' => $this->input->get('maintenance_id') ) );
                    if( $parts->num_rows() > 0 )
                        $result = array( 'success' => 1, 'result' => $parts->result());
                    else
                        $result = array( 'success' => 0 );

                    echo json_encode( $result );
                    break;
                
                
                case 'create_maintenance':
                    $update = $this->maintenance_model->add_unit_maintenance( $this->input->post() );
                    if( $update )
                    {
                        $this->session->set_flashdata('msg', '<strong><i class="fa fa-database"></i> Success!</strong> Maintenance has been added.');
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