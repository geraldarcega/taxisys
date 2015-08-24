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
        $this->load->model('calendar_model');
        
        $this->maintenance_model->user_id = $this->userdata->id;
    }

    public function index( )
    {
        $filter = array();
        $sort = array();
        if($this->input->get('sort'))
            $sort = array( 'field' => $this->input->get('sort'), 'direction' => $this->input->get('sort_order') );

        # Units data
        $this->data['units'] = $this->units_model->read( $filter, null, null, $sort );
        
        # Maintenance data
        $this->data['maintenance'] = Modules::run( 'dashboard/maintenance/get_maintenance', array( 'wh|is_scheduled' => 1 ), true );
        
        $this->load_view( 'all_units' );
    }

    public function maintenance( $type, $unit_id )
    {
    	$_type = array('scheduled' => 1, 'unscheduled' => 0);

        if( !isset($_type[$type]) && ($unit_id == '' || !is_numeric($unit_id)) )
            redirect( dashboard_url('units') );
        
        # Maintenance data
        $this->data['maintenance'] = Modules::run( 'dashboard/maintenance/get_maintenance', array( 'wh|is_scheduled' => $_type[$type] ), true );
        
        # Unit data
        $unit = $this->get_unit_details($unit_id);
		
        if( !$unit )
            redirect( dashboard_url('units') );

        $this->data['unit']    = (object) $unit;
        $this->data['sub_nav'] = 'maintenance ('.strtoupper($this->data['unit']->plate_number).')';

        $this->load_view( 'maintenance' );
    }
    
    public function get_unit_maintenance_by_status( $unit_id, $status, $filter = array(), $limit = null, $group = null, $sort = array() ) {
    	$filter1 = array (
				'wh|um.unit_id' => $unit_id,
				'wh|um.status' => $status 
		);
    	if( !empty( $filter ) )
    		$filter1 = array_merge($filter1, $filter);
    	
    	$unit_maintenance = $this->maintenance_model->get_unit_maintenance ( $filter1, $limit, null, $group, $sort );
    	$_maintenance = array();
    	if( $unit_maintenance->num_rows() > 0 )
    	{
    		foreach ($unit_maintenance->result() as $maintenance)
    			$_maintenance[ $maintenance->unit_id ][ $maintenance->maintenance_id ] = $maintenance;
    	}
    	
    	return $_maintenance;
    }

    public function get_unit_maintenance( $unit_id, $maintenance_id )
    {
    	$maintenance = $this->maintenance_model->get_unit_maintenance( 
    		 array( 'wh|unit_id' => $unit_id, 'wh|maintenance_id' => $maintenance_id )
    		,1
    		,null
    		,'unit_id, maintenance_id'
    	);
    	if( $maintenance->num_rows() > 0 )
    		return $maintenance->result_array();
    	else
    		return false;
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
                    	$this->session->set_flashdata('msg', array( 'text' => '<strong><i class="fa fa-database"></i> Success!</strong> Unit\'s details has been updated.', 'class' => 'alert-success' ));
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
                
                case 'update_odometer':
                    $update = $this->units_model->update($this->input->post());
                    $unit = $this->get_unit_details($this->input->post('unit_id'));
                    
                    echo json_encode( array( 'success' => $update, 'unit_data' => json_encode( $unit ) ) );
                    break;
                
                case 'apply_maintenance':
                    $new = $this->maintenance_model->add_unit_maintenance($this->input->post());
                    if( $new ) {
                    	$date_from = strtotime ( $this->input->post('date_from') );
                    	if( $date_from >= strtotime( date('M d, Y') ) )
                    		$this->units_model->update_status($this->input->post('unit_id'), UNIT_MAINTENANCE);
                    	
                    	# save to sched to calendar
                    	$this->calendar_model->create(
	                    	 $this->input->post('unit_id')
	                    	,$new
	                    	,$this->input->post('allday')
	                    	,$this->input->post('date_from')
	                    	,$this->input->post('time_from')
	                    	,$this->input->post('date_to')
	                    	,$this->input->post('time_to')
	                    );;
                    	
                    	$this->session->set_flashdata('msg', array('class' => 'alert-success', 'text' => '<strong><i class="fa fa-database"></i> Success!</strong> Unit is now under maintenance.') );
                    	$msg = array( 'success' => 1 );
                    }
                    else
                    	$msg = array( 'success' => 0, 'alert' => array('class' => 'alert-warning', 'text' => 'Failed! There\'s something wrong with the system, contact administrator.') );
                    
                    echo json_encode( $msg );
                    break;
                
                case 'update_applied_maintenance':
                    $update = $this->maintenance_model->update_unit_maintenance($this->input->post());

                    # save to sched to calendar
                    $this->calendar_model->update(
                    	 $this->input->post('unit_id')
                    	,$this->input->post('unit_maintenance_id')
                    	,$this->input->post('allday')
                    	,$this->input->post('date_from')
                    	,$this->input->post('time_from')
                    	,$this->input->post('date_to')
                    	,$this->input->post('time_to')
                    );
                    
                    if( $update ) {
                    	if( $this->input->post('status') != '' )
                    	{
                    		$msg_val = $this->input->post('status') == 1 ? 'Unit maintenance has been completed.' : 'Unit maintenance has been cancelled.';
                    		$this->units_model->update_status($this->input->post('unit_id'), 2);
                    	}
						else
							$msg_val = 'Unit maintenance details is now updated.';

                    	$this->session->set_flashdata('msg', array('class' => 'alert-success', 'value' => '<strong><i class="fa fa-database"></i> Success!</strong> '.$msg_val) );
                    	$msg = array( 'success' => 1 );
                    }
                    else
                    	$msg = array( 'success' => 0, 'alert' => array('class' => 'alert-warning', 'msg' => 'Failed! There\'s something wrong with the system, contact administrator.') );
                    
                    echo json_encode( $msg );
                    break;
                
                case 'get_unit_maintenance':
                    $maintenance = $this->get_unit_maintenance( $this->input->post('unit_id'), $this->input->post('maintenance_id') );
                    $success = is_array( $maintenance ) ? 1 : 0;
                    
                	echo json_encode( array('success' => $success, 'data' => $maintenance) );
                    break;

				case 'archive':
					$archived = $this->units_model->archive( $this->input->post('unit_id') );
                    if( $archived )
                    {
                    	$this->session->set_flashdata('msg', array( 'text' => '<strong><i class="fa fa-database"></i> Success!</strong> Unit\'s details has been updated.', 'class' => 'alert-success' ));
                    	$msg = array( 'success' => 1 );
                    }
                    else
                    {
                    	$this->session->set_flashdata('msg', array( 'text' => '<strong><i class="fa fa-database"></i> Oops!</strong> Something is wrong with the system, contact admin.', 'class' => 'alert-danger' ));
                    	$msg = array( 'success' => 0 );
                    }
                    
                    echo json_encode( array('success' => $success, 'data' => $maintenance) );
                    break;
                    
                default:
                    # code...
                    break;
            }
        }
        else
            redirect( dashboard_url(), '301' );
    }
    
   public function get_unit_details( $unit_id ) {
   	# Unit data
   	$unit = $this->units_model->read( array( 'wh|u.id' => $unit_id ) );
   	
   	if( $unit->num_rows() > 0 )
   	{
   		$unit = $unit->row_array();
   		$unit ['maintenance'] ['ongoing'] = $this->get_unit_maintenance_by_status (
   				$unit_id,
   				Maintenance_model::STATUS_ONGOING
   		);
   		$unit ['maintenance'] ['past'] = $this->get_unit_maintenance_by_status (
   				$unit_id,
   				Maintenance_model::STATUS_DONE,
   				array (),
   				1,
   				'unit_id,maintenance_id',
   				array (
   						'desc' => array (
   								'prefered_date',
   								'prefered_time'
   						)
   				)
   		);
   		return $unit;
   	}
   	else
   		return false;
   }
}