<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parts_model extends CI_Model {

	private $table = 'parts';
	private $logs  = 'parts_logs';
	
	function __construct(){
		parent::__construct();
	}

	public function read($filter = array(), $limit = null, $offset = null, $one = false) {
		if( count($filter) )
			$this->db->filter( $filter );

		if( !is_null($limit) && !is_null($offset) )
			$this->db->limit( $limit, $offset );
	
		return $this->db
					->where( 'deleted_at IS NULL', null )
					->get( $this->table );
	}
	
	public function create( $db_data ) {
		$db_data['purchase_date'] = date( 'Y-m-d', strtotime($db_data['purchase_date']) );
		unset($db_data['parts_id']);
		unset($db_data['action']);

		if( $this->check_exists( $db_data['name'] ) > 0 )
			return array( 'exists' => true );
	
		$this->db->insert( $this->table, $db_data );
	
		return $this->db->insert_id();
	}
	
	public function create_logs( $db_data ) {
		$db_data['purchase_date'] = date( 'Y-m-d', strtotime($db_data['purchase_date']) );
		unset($db_data['parts_id']);
		unset($db_data['action']);

		if( $this->check_exists( $db_data['name'] ) > 0 )
			return array( 'exists' => true );
	
		$this->db->insert( $this->table, $db_data );
	
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

	# check if parts already exist
	public function check_exists( $name )
	{
		return $this->db
		            ->where( 'name', $name )
		            ->count_all_results( $this->table );
	}

}

/* End of file parts_model.php */
/* Location: ./application/modules/dashboard/models/parts_model.php */