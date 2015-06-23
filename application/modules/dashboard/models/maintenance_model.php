<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance_model extends CI_Model {
	private $table = 'maintenance';
	private $details = 'maintenance_details';
	
	function __construct(){
		parent::__construct();
	}
	
	public function read($filter = array(), $limit = null, $offset = null, $one = false) {
		if( count($filter) )
			$this->db->filter( $filter );

		if( !is_null($limit) && !is_null($offset) )
			$this->db->limit( $limit, $offset );
	
		return $this->db
					->get( $this->table );
	}
	
	public function create( $db_data ) {
		$db_data['name'] = $db_data['m_type'];
	
		unset($db_data['maintenance_id']);
		unset($db_data['action']);
		unset($db_data['m_type']);

		if( $this->check_exists( $db_data['name'] ) > 0 )
			return array( 'exists' => true );
	
		$this->db->insert( $this->table, $db_data );
	
		return $this->db->insert_id();
	}
	
	public function create_maintenance_details( $unit_id, $db_data, $parts = array() ) {
		unset($db_data['action']);
		unset($db_data['maintenance_id']);
		unset($db_data['parts']);
		unset($db_data['parts_count']);

		$this->db->insert( $this->details, $db_data );
	
		return $this->db->insert_id();
	}
	
	public function update( $db_data ) {
		$maintenance_id = $db_data['maintenance_id'];
		$db_data['name'] = $db_data['m_type'];
	
		unset($db_data['maintenance_id']);
		unset($db_data['action']);
		unset($db_data['m_type']);
	
		$this->db
			 ->where( 'maintenance_id', $maintenance_id )
			 ->update( $this->table, $db_data );
	
		return $this->db->affected_rows();
	}

	# check if unit already exist
	public function check_exists( $type )
	{
		return $this->db
		            ->where( 'name', $type )
		            ->count_all_results( $this->table );
	}

	public function get_maintenance( $unit_id, $filter = array() )
	{
		if( count($filter) )
			$this->db->filter( $filter );
	
		return $this->db
					->where( 'unit_idFK', $unit_id )
					->get( $this->sched );
	}
}

/* End of file maintenance_model.php */