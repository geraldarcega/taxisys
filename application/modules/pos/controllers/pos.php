<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pos extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('pos_model');
        $this->load->model('dashboard/units_model');
        $this->load->model('dashboard/drivers_model');
        // $this->top_nav = false;
    }

    # dashboard units
    public function index( )
    {
        $now = date('Y-m-d');

        $this->data['sub_nav']    = 'units';
        $groups = array (
        		'MON' => 'monday',
        		'TUE' => 'tuesday',
        		'WED' => 'wednesday',
        		'THUR' => 'thursday',
        		'FRI' => 'friday'
        );
        $this->data['groups'] = $groups;
        
        foreach ( $groups as $key => $val )
        	$this->data['units'][$val]		= $this->units_model->read( array( 'wh|u.coding_day' => constant("DAY_{$key}") ) );

        $this->data['drivers'] = $this->drivers_model->read();

        $this->load_view( 'units' );
    }

    public function drivers( )
    {
        $this->data['sub_nav']    = 'drivers';
        $this->load_view( 'drivers' );
    }

    public function ajax()
    {
        // debug($this->input->post());exit();
        if( $this->input->is_ajax_request() )
        {
            switch ($this->input->post('action')) {
                case 's_update':
                    $driver_stats = $this->input->post('status') == UNIT_DUTY ? DRIVER_DUTY : DRIVER_OFF;
                    
                    // $this->pos_model->create_log( $this->input->post() );
                    $this->drivers_model->assign( $this->input->post('select_driver'), $this->input->post('unit_id'), $driver_stats );
                    $this->units_model->update_status( $this->input->post('unit_id'), $this->input->post('status') );
                    $msg = array( 'text' => '<strong>Success!</strong> Unit is now '.unitStatus($this->input->post('status')), 'class' => 'alert-success' );
                    break;
                
                case 'u_update':
                    $return = $this->pos_model->create($this->input->post(), $this->userdata->id);
                    $msg = array( 'text' => '<strong>Well done!</strong> Trasaction saved!', 'class' => 'alert-success' );
                    if( $return > 0 )
                    {
                        $msg = array( 'success' => 1 );
                    }
                    else
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> Driver '.$this->input->post('fname').' '.$this->input->post('lname').' is already exists.' );
                    break;
                
                default:
                    # code...
                    break;
            }

            $old_status = $this->input->post('old_status');
            $new_status = $this->input->post('status');
            if( $new_status != $old_status ){
                $element = array( 'div' => unitStatusWrapper($new_status), 'old_class' => unitStatusClass($old_status), 'new_class' => unitStatusClass($new_status), 'data_type' => $new_status );
            }

            $return = array( 'taxi' => 'taxi_'.$this->input->post('unit_id'), 'element' => $element, 'msg' => $msg );
            echo json_encode($return);
            exit();
        }
        else
            redirect( dashboard_url() );
    }

    public function login( )
    {
        if( $this->data['user_data'] )
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
                
                $r = $this->session->userdata('r') != '' ? urldecode($this->session->userdata('r')) : base_url('pos');
                $this->session->unset_userdata('r');

                $msg = array( 'success' => true, 'r' => $r );
            }
            else
                $msg = array( 'success' => false );

            echo json_encode( $msg );
        }
        else
        {
            $this->top_nav = false;
            $this->load_view( 'login', false );
        }
    }

    public function logout( )
    {
        $this->session->sess_destroy();

        redirect( pos_url( 'login' ) );
    }

}