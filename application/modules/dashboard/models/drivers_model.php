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
                  ->get( $this->table );
    }

    public function create( $type, $db_data ) {
  		return false;
    }

    public function update( $type, $db_data ) {
  		return false;
    }
}