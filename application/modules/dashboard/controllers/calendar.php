<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendar extends MY_Framework
{
    function __construct()
    {
        parent::__construct();

        $this->top_nav = false;
        $this->load->model('units_model');
        $this->load->model('maintenance_model');
    }

    public function index( )
    {
//     	title: 'Meeting',
//     	start: '2015-02-13T11:00:00',
//     	constraint: 'availableForMeeting', // defined below
//     	color: '#257e4a'
   
        $this->data['nav'] = 'calendar';
        
        $this->load_view( 'index' );
	}
	
	public function ajax() {
		if( $this->input->is_ajax_request() )
		{
			switch ( $this->input->post('action') ) {
				case 'get':
					$calendar = array();
					$schedules = array(
							'Maintenance' => array('key' => 'date_from', 'color' => '#d9534f')
							,'Resealing 1' => array('key' => 'resealing_date1', 'color' => '#6227C7')
							,'Resealing 2' => array('key' => 'resealing_date2', 'color' => '#C1DE17')
							,'Franchise' => array('key' => 'franchise_until', 'color' => '#ec971f')
							,'Renew' => array('key'=> 'renew_by', 'color' => '#5bc0de')
					);
					
					$unit_scheds = $this->units_model->get_schedules( $this->input->post('start'),  $this->input->post('end') );
					if( $unit_scheds->num_rows() > 0 )
					{
						foreach ( $unit_scheds->result() as $u_scheds )
						{
							foreach ( $schedules as $key => $sched ){
								if( isset($u_scheds->{$sched['key']}) )
								{
									$plate_number = str_replace(' ', '-', strtoupper($u_scheds->plate_number) );
									$calendar[] = array(
											'id'	=> $sched['key'].'_'.$u_scheds->id,
											'unitid'=> $u_scheds->id,
											'plate' => $plate_number,
											'title' => '['.$plate_number.'] '.$key,
											'start' => $u_scheds->{$sched['key']},
											'color' => $sched['color']
									);
								}
							}
						}
					}
					
					$unit_maintenance = $this->maintenance_model->get_maintenance_schedules( $this->input->post('start'),  $this->input->post('end') );
					if( $unit_maintenance->num_rows() > 0 )
					{
						foreach ( $unit_maintenance->result() as $u_maintenance )
						{
							foreach ( $schedules as $key => $sched ){
								if( isset($u_maintenance->{$sched['key']}) )
								{
									$plate_number = str_replace(' ', '-', strtoupper($u_maintenance->plate_number) );
									$calendar[] = array(
											'id'	=> $sched['key'].'_'.$u_maintenance->id,
											'unitid'=> $u_maintenance->id,
											'plate' => $plate_number,
											'notes' => $u_maintenance->notes,
											'title' => '['.$plate_number.'] '.$u_maintenance->name,
											'start' => $u_maintenance->date_from,
											'end'	=> $u_maintenance->date_to != null ? date( 'c', strtotime($u_maintenance->date_to) ) : null,
											'color' => $sched['color']
									);
								}
							}
						}
					}
					
					echo json_encode($calendar);
					break;
				
				default:
					break;
			}
		}
		else
			redirect( dashboard_url('calendar') );
	}

}