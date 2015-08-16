<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Drivers_model extends CI_Model {
	private $table = 'drivers';

    function __construct(){
        parent::__construct();
    }

    public function read($filter = array(), $limit = null, $offset = null, $one = false) {
    	if( count($filter) )
    		$this->db->filter( $filter );

    	return $this->db
    				->select( 'd.*, u.id unit_id, u.plate_number' )
                    ->join( 'units u', 'd.unit_id = u.id', 'left' )
                    ->where( 'd.deleted_at IS NULL', null, false )
                    ->order_by( 'u.plate_number', 'DESC' )
                    ->get( $this->table.' d' );
    }

    public function create( $db_data ) {
    	if( isset($db_data['unit']) )
    		$db_data['unit_id'] = $db_data['unit'] != '' ? $db_data['unit'] : null;

        unset($db_data['unit']);
        unset($db_data['action']);
        unset($db_data['driver_id']);

        $db_data['birthday'] = dateFormat( $db_data['birthday'] );
        if( $this->check_exists( $db_data ) > 0 )
            return array( 'exist' => true );

        $this->db->insert( $this->table, $db_data );

        return $this->db->insert_id();
    }

    public function update( $db_data ) {
        $driver_id = $db_data['driver_id'];
        
        if( isset($db_data['unit']) )
        	$db_data['unit_id'] = $db_data['unit'] != '' ? $db_data['unit'] : null;
        
        if( $db_data['action'] == 'remove' )
        	$db_data['deleted_at'] = date('Y-m-d H:i:s');

        unset($db_data['driver_id']);
        unset($db_data['full_name']);
        unset($db_data['action']);
        unset($db_data['unit']);
		
        if( isset( $db_data['birthday'] ) )
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