<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Units_model extends CI_Model {
  private $table = 'units';

  function __construct(){
    parent::__construct();
  }

  public function read($filter = array(), $limit = null, $offset = null, $one = false) {
    if( count($filter) )
      $this->db->filter( $filter );

    return $this->db
                ->get( $this->table );
  }

  public function create( $db_data ) {
    $this->db->insert( $this->table, $db_data );
  }
}