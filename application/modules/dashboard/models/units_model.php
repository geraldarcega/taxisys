<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Units_model extends CI_Model {
  private $table  = 'units';

  function __construct(){
    parent::__construct();
  }

  public function read($filter = array(), $fields = '*', $limit = null, $offset = null, $one = false) {
    if( count($filter) )
      $this->db->filter( $filter );

    return $this->db
                ->select( $fields )
                ->get( $this->table );
  }

  public function create( $db_data ) {
    $date_fields = array(
                           'releasing_date1'
                          ,'releasing_date2'
                          ,'franchise_until'
                          ,'renew_by'
                        );
    if( isset($db_data['action']) )
      unset($db_data['action']);

    for ($i=0; $i < count($date_fields); $i++) { 
      $db_data[$date_fields[$i]] = dateFormat( $db_data[$date_fields[$i]] );
    }

    $this->db->insert( $this->table, $db_data );

    return $this->db->affected_rows();
  }
}