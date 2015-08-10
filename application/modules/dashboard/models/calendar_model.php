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

    public function create( $db_data, $unit_id = null, $unit_maintenance_id = null ) {
    	if( !is_null( $unit_maintenance_id ) )
    		$db_data['unit_maintenance_id'] = $unit_maintenance_id;
    	if( !is_null( $unit_id ) )
    		$db_data['unit_id'] = $unit_id;
    	
        $db_data ['date_from'] = date ( 'Y-m-d', strtotime ( $db_data ['date_from'] ) );
        $db_data ['time_from'] = date ( 'H:i:s', strtotime ( $db_data ['time_from'] ) );
        if( $db_data ['date_to'] != '' )
        {
        	$db_data ['date_to'] = date ( 'Y-m-d', strtotime ( $db_data ['date_to'] ) );
        	$db_data ['time_to'] = date ( 'H:i:s', strtotime ( $db_data ['time_to'] ) );
        }
        else 
        {
        	unset($db_data['date_to']);
        	unset($db_data['time_to']);
        }
		
        unset($db_data['multi_day']);
        unset($db_data['action']);
        unset($db_data['maintenance_id']);
        unset($db_data['m_odometer']);
        unset($db_data['status']);
        unset($db_data['notes']);
        
        $this->db->insert( $this->table, $db_data );

        return $this->db->insert_id();
    }

    public function update( $db_data ) {
        $driver_id = $db_data['driver_id'];
        $db_data['unit_id'] = $db_data['unit'];

        unset($db_data['driver_id']);
        unset($db_data['action']);
        unset($db_data['unit']);

        $db_data['birthday'] = dateFormat( $db_data['birthday'] );

        $this->db
             ->where( 'id', $driver_id )
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