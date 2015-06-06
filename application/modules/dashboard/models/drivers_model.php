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
                    ->join( 'units u', 'd.unit_idFK = u.unit_id', 'left' )
                    ->order_by( 'u.plate_number', 'ASC' )
                    ->get( $this->table.' d' );
    }

    public function create( $db_data ) {
        $db_data['unit_idFK'] = $db_data['unit'];

        unset($db_data['unit']);
        unset($db_data['action']);
        unset($db_data['driver_id']);

        $db_data['dob'] = dateFormat( $db_data['dob'] );
        if( $this->check_exists( $db_data ) > 0 )
            return array( 'exist' => true );

        $this->db->insert( $this->table, $db_data );

        return $this->db->insert_id();
    }

    public function update( $db_data ) {
        $driver_id = $db_data['driver_id'];
        $db_data['unit_idFK'] = $db_data['unit'];

        unset($db_data['driver_id']);
        unset($db_data['action']);
        unset($db_data['unit']);

        $db_data['dob'] = dateFormat( $db_data['dob'] );

        $this->db
             ->where( 'driver_id', $driver_id )
             ->update( $this->table, $db_data );

        return $this->db->affected_rows();
    }

    # Check if driver exists
    public function check_exists( $data ) {
        return $this->db
                    ->where('fname', $data['fname'])
                    ->where('mname', $data['mname'])
                    ->where('lname', $data['lname'])
                    ->where('dob', $data['dob'])
                    ->count_all_results( $this->table );
    }
}