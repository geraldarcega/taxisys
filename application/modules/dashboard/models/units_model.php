<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Units_model extends CI_Model {
  private $table  = 'units';

  function __construct(){
    parent::__construct();
  }

  public function read( $filter = array(), $fields = '*', $limit = null, $offset = null, $sort = array(), $one = false ) {
    if( count($filter) )
      $this->db->filter( $filter );

    if( count( $sort ) )
      $this->db->order_by( $sort['field'], $sort['direction'] );
    
    return $this->db
                ->select( $fields )
                ->join( 'drivers', 'driver_idFK = driver_id', 'left' )
                ->get( $this->table );
  }

  public function create( $db_data ) {
    $date_fields = array(
                           'releasing_date1'
                          ,'releasing_date2'
                          ,'franchise_until'
                          ,'renew_by'
                        );
    if( isset($db_data['plate_number1']) && isset($db_data['plate_number2']) )
    {
      $db_data['plate_number'] = $db_data['plate_number1'].' '.$db_data['plate_number2'];
      
      if( $this->check_exist( $db_data['plate_number'] ) > 0 )
      {
        return array('exist' => strtoupper($db_data['plate_number']));
      }

      unset($db_data['plate_number1']);
      unset($db_data['plate_number2']);
    }

    unset($db_data['action']);
    unset($db_data['unit_id']);

    for ($i=0; $i < count($date_fields); $i++) {
      $db_data[$date_fields[$i]] = dateFormat( $db_data[$date_fields[$i]] );
    }

    $this->db->insert( $this->table, $db_data );

    if( $this->db->affected_rows() )
      $this->db->insert( $this->table.'_logs', array( 'unit_idFK' => $this->db->insert_id(), 'status' => ONGARRAGE ) );

    return $this->db->affected_rows();
  }

  public function update( $db_data ) {
    $date_fields = array(
                           'releasing_date1'
                          ,'releasing_date2'
                          ,'franchise_until'
                          ,'renew_by'
                        );
    if( isset($db_data['plate_number1']) && isset($db_data['plate_number2']) )
    {
      $db_data['plate_number'] = $db_data['plate_number1'].' '.$db_data['plate_number2'];

      unset($db_data['plate_number1']);
      unset($db_data['plate_number2']);
    }

    unset($db_data['action']);

    if( isset($db_data['unit_id']) )
    {
      $this->db->where( 'unit_id', $db_data['unit_id'] );
      unset($db_data['unit_id']);
    }

    for ($i=0; $i < count($date_fields); $i++) {
      $db_data[$date_fields[$i]] = dateFormat( $db_data[$date_fields[$i]] );
    }

    $this->db->update( $this->table, $db_data );

    return $this->db->affected_rows();
  }

  # check if unit already exist
  public function check_exist( $plate_number )
  {
    return $this->db
                ->where( 'plate_number', $plate_number )
                ->count_all_results( $this->table );
  }
}