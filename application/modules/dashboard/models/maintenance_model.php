<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance_model extends CI_Model {
	private $table = 'maintenance';
	private $mparts = 'maintenance_parts';
	private $parts = 'parts';
	private $units = 'units_maintenance';
	
	function __construct(){
		parent::__construct();
	}
	
	public function read($filter = array(), $limit = null, $offset = null, $one = false) {
		if( count($filter) )
			$this->db->filter( $filter );

		if( !is_null($limit) && !is_null($offset) )
			$this->db->limit( $limit, $offset );
	
		return $this->db
					->select( $this->table.'.*, '.$this->mparts.'.parts_idFK, '.$this->mparts.'.count' )
					->join( $this->mparts, $this->mparts.'.maintenance_idFK = '.$this->table.'.maintenance_id', 'left' )
					->get( $this->table );
	}
	
	public function create( $db_data ) {
		$db_data['name'] = $db_data['m_type'];
	
		unset($db_data['maintenance_id']);
		unset($db_data['action']);
		unset($db_data['m_type']);
		unset($db_data['parts']);
		unset($db_data['parts_count']);

		if( $this->check_exists( $db_data['name'] ) > 0 )
			return array( 'exists' => true );
	
		$this->db->insert( $this->table, $db_data );
	
		return $this->db->insert_id();
	}
	
	public function assign_parts( $maintenance_id, $parts_id, $cnt ) {
		$this->db->insert( $this->mparts, array( 'maintenance_idFK' => $maintenance_id, 'parts_idFK' => $parts_id, 'count' => $cnt ) );
	
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

	public function get_maintenance_parts( $filter = array() )
	{
		if( count($filter) )
			$this->db->filter( $filter );
	
		return $this->db
					->join( $this->parts, $this->parts.'.parts_id = '.$this->mparts.'.parts_idFK', 'left' )
					->get( $this->mparts );
	}

	public function add_unit_maintenance( $db_data )
	{
		$db_data['unit_idFK'] = $db_data['unit_id'];
		$db_data['maintenance_idFK'] = $db_data['maintenance'];
		$db_data['odometer'] = $db_data['current'];
		$db_data['schedule'] = dateFormat($db_data['schedule']);
	
		unset($db_data['unit_maintenance_id']);
		unset($db_data['unit_id']);
		unset($db_data['action']);
		unset($db_data['uns_maintenance']);
		unset($db_data['current']);
		unset($db_data['maintenance']);
	
		$this->db->insert( $this->units, $db_data );
	
		return $this->db->insert_id();
	}
}

/* End of file maintenance_model.php */