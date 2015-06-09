<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Garrage_model extends CI_Model {
	private $table = 'garrage';

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
        unset($db_data['garrage_id']);
        unset($db_data['action']);

        $this->db->insert( $this->table, $db_data );

        return $this->db->insert_id();
    }

    public function update( $db_data ) {
        $garrage_id = $db_data['garrage_id'];
        unset($db_data['garrage_id']);
        unset($db_data['action']);

        $this->db
             ->where( 'garrage_id', $garrage_id )
             ->update( $this->table, $db_data );

        return $this->db->affected_rows();
    }
}