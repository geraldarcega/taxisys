<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pos_model extends CI_Model {
  private $table        = 'pos';
  private $units        = 'units';
  private $logs         = 'units_logs';
  private $drivers_acct = 'drivers_acct';

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
                ->join( 'drivers d', 'd.unit_idFK = u.unit_id', 'left' )
                ->get( $this->table.' u' );
  }

  public function create( $db_data ) {
    $day = date('N');
    # Sunday boundary
    if( $day == DAY_SUN )
      $pos_data['day_type'] = BTYPE_SUNDAY;

    # Coding boundary
    if( $db_data['coding_day'] == $day )
      $pos_data['day_type'] = BTYPE_CODING;

    $pos_data['unit_idFK']   = $db_data['unit_id'];
    $pos_data['boundary']    = $db_data['boundary'];
    $pos_data['remarks']     = $db_data['remarks'];
    if( $db_data['short'] > 0 )
      $pos_data['status'] = 2;

    $driver_data['driver_idFK'] = $pos_data['driver_idFK'] = $db_data['old_driver'];
    $driver_data['in']          = $db_data['drivers_fund'];
    $driver_data['out']         = $db_data['short'];

    // $logs_data['status'] = $db_data['status'];

    # Insert transaction in pos
    $this->db->insert( $this->table, $pos_data );
    $driver_data['trans_idFK'] = $this->db->insert_id();

    # Logs driver acct
    $this->db->insert( $this->drivers_acct, $driver_data );

    # Update unit
    $this->db
         ->where( 'unit_id', $pos_data['unit_idFK'] );
         ->update( $this->units, $unit_data );

    return $this->db->affected_rows();
  }

  public function update( $db_data ) {
    $unit_id = $db_data['unit_id'];

    if( $db_data['old_driver'] != $db_data['select_driver'] )
      $db_data['driver_idFK'] = $db_data['select_driver'];

    unset($db_data['action']);
    unset($db_data['unit_id']);
    unset($db_data['old_driver']);
    unset($db_data['select_driver']);
    unset($db_data['old_status']);
    debug($db_data);exit();
    $this->db
         ->where( 'unit_idFK', $unit_id )
         ->update( $this->table, $db_data );

    return $this->db->affected_rows();
  }

  public function insert_drivers_boundary( $trans_id, $driver_id, $in = 0, $out = null, $remarks = null ) {
    $this->db->insert( $this->drivers_acct, array( 'trans_idFK' => $trans_id, 'drivers_idFK' => $driver_id, 'in' => $in, 'out' => $out, 'remarks' => $remarks ) );

    return $this->db->affected_rows();
  }

  # check if unit already exist
  public function check_exist( $plate_number )
  {
    return $this->db
                ->where( 'plate_number', $plate_number )
                ->count_all_results( $this->table );
  }

  # check if unit is on-duty
  public function check_duty( $unit_id )
  {
    return $this->db
                ->where( 'unit_idFK', $unit_id )
                ->count_all_results( $this->table );
  }

  # Logs unit
  public function create_log( $data = array() )
  {
    # check if driver ID and unit ID still the same
    $check = $this->db
                  ->where( 'driver_idFK', $data['select_driver'])
                  ->where( 'unit_idFK', $data['unit_id'] )
                  ->count_all_results( $this->logs );
    if( $check > 0 )
      return false;

    $data['driver_idFK'] = $data['select_driver'];
    $data['unit_idFK'] = $data['unit_id'];

    unset($data['action']);
    unset($data['unit_id']);
    unset($data['old_status']);
    unset($data['old_driver']);
    unset($data['select_driver']);

    $this->db->insert( $this->logs, $data);
    return $this->db->affected_rows();
  }
}