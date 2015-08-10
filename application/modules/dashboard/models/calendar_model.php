<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_model extends CI_Model {
	private $table = 'calendar';

    function __construct(){
        parent::__construct();
    }

    public function read($filter = array(), $limit = null, $offset = null, $one = false) {
    	if( count($filter) )
    		$this->db->filter( $filter );

    	return $this->db
    				->select( 'd.*, u.id unit_id, u.plate_number' )
                    ->join( 'units u', 'd.unit_id = u.id', 'left' )
                    ->order_by( 'u.plate_number', 'ASC' )
                    ->get( $this->table.' d' );
    }

    public function create( $unit_id = null, $unit_maintenance_id = null, $allday = 0, $date_from = null, $time_from = null, $date_to = null, $time_to = null ) {
    	if( !is_null( $unit_maintenance_id ) )
    		$db_data['unit_maintenance_id'] = $unit_maintenance_id;
    	if( !is_null( $unit_id ) )
    		$db_data['unit_id'] = $unit_id;
    	
    	$db_data ['allday']	   = $allday;
        $db_data ['date_from'] = date ( 'Y-m-d', strtotime ( $date_from ) );
        $db_data ['time_from'] = !$allday ? date ( 'H:i:s', strtotime ( $time_from ) ) : null;
        if( !is_null($date_to) )
        {
        	$db_data ['date_to'] = date ( 'Y-m-d', strtotime ( $date_to ) );
        	$db_data ['time_to'] = !$allday ? date ( 'H:i:s', strtotime ( $time_to ) ) : null;
        }
        
        $this->db->insert( $this->table, $db_data );

        return $this->db->insert_id();
    }

    public function update( $unit_id = null, $unit_maintenance_id = null, $allday = 0, $date_from = null, $time_from = null, $date_to = null, $time_to = null ) {
    	if( !is_null( $unit_maintenance_id ) )
    		$filter['wh|unit_maintenance_id'] = $unit_maintenance_id;
    	if( !is_null( $unit_id ) )
    		$filter['wh|unit_id'] = $unit_id;
    	
    	if( isset( $filter ) )
    		$this->db->filter( $filter );
    	
    	$db_data ['allday']	   = $allday;
        $db_data ['date_from'] = date ( 'Y-m-d', strtotime ( $date_from ) );
        $db_data ['time_from'] = !$allday ? date ( 'H:i:s', strtotime ( $time_from ) ) : null;
        if( $date_to != '' )
        {
        	$db_data ['date_to'] = date ( 'Y-m-d', strtotime ( $date_to ) );
        	$db_data ['time_to'] = !$allday ? date ( 'H:i:s', strtotime ( $time_to ) ) : null;
        }
        else
        {
        	$db_data ['date_to'] = null;
        	$db_data ['time_to'] = null;
        }

        $this->db
             ->update( $this->table, $db_data );

        return $this->db->affected_rows();
    }

    public function assign( $driver_id, $unit_id, $status = DRIVER_DUTY ) {
        $this->db
             ->where( 'id', $driver_id )
             ->update( $this->table, array( 'unit_id' => $unit_id, 'status' => $status ) );

        return $this->db->affected_rows();
    }

    # Check if driver exists
    public function check_exists( $data ) {
        return $this->db
                    ->where('first_name', $data['first_name'])
                    ->where('middle_name', $data['middle_name'])
                    ->where('last_name', $data['last_name'])
                    ->where('birthday', $data['birthday'])
                    ->count_all_results( $this->table );
    }
}