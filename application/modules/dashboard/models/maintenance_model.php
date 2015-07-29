<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance_model extends CI_Model {
	private $table = 'maintenance';
	private $mparts = 'maintenance_parts';
	private $parts = 'parts';
	private $units = 'units_maintenance';
	
	public $user_id;
	
	const INTERVAL_ODOMETER = 1;
	const INTERVAL_MONTHLY	= 2;
	const INTERVAL_WEEKLY	= 3;
	
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
	
		unset($db_data['id']);
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
		$check = $this->check_maintenance_parts($maintenance_id, $parts_id);
		if( $check > 0 )
		{
			$now = date('Y-m-d H:i:s');
			$this->db
				 ->where('maintenance_id', $maintenance_id)
				 ->where('parts_id', $parts_id)
				 ->update( $this->mparts, array( 'count' => $cnt, 'updated_at' => $now, 'deleted_at' => null ) );
			return $this->db->affected_rows();
		}
		else
		{
			$this->db->insert( $this->mparts, array( 'maintenance_id' => $maintenance_id, 'parts_id' => $parts_id, 'count' => $cnt ) );
			return $this->db->insert_id();
		}
	}
	
	public function update( $db_data ) {
		$maintenance_id = $db_data['id'];
		$db_data['name'] = $db_data['m_type'];
	
		unset($db_data['id']);
		unset($db_data['action']);
		unset($db_data['m_type']);
		unset($db_data['parts']);
		unset($db_data['parts_count']);
		
		if( !isset($db_data['is_scheduled']) )
			$db_data['is_scheduled'] = 0;
			
		$this->db
			 ->where( 'id', $maintenance_id )
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
					->join( $this->parts, $this->parts.'.id = '.$this->mparts.'.parts_id', 'left' )
					->where( $this->mparts.'.deleted_at IS NULL', null )
					->get( $this->mparts );
	}

	public function add_unit_maintenance( $db_data )
	{
		unset($db_data['action']);
		$db_data['created_by'] = $this->user_id;
		
		$this->db->insert( $this->units, $db_data );
	
		return $this->db->insert_id();
	}

	public function get_unit_maintenance( $filter = array(), $limit = null, $offset = null, $group = null, $order = array() )
	{
		if (!empty($filter))
			$this->db->filter($filter);
		
		if( !is_null($group) )
			$this->db->group_by( $group );
		
		return $this->db
					->get( $this->units, $limit, $offset );
	}
	
	public function check_maintenance_parts($maintenance_id, $parts_id = null) {
		if( !is_null($parts_id) )
			$this->db->where('parts_id', $parts_id);
		
		return $this->db
					->where('maintenance_id', $maintenance_id)
					->count_all_results($this->mparts);
	}
	


	public function remove_maintenance_parts($maintenance_id) {
		$now = date('Y-m-d H:i:s');
		$this->db
			->where('maintenance_id', $maintenance_id)
			->update($this->mparts, array( 'deleted_at' => $now ) );
		
		return $this->db->affected_rows();
	}
}

/* End of file maintenance_model.php */