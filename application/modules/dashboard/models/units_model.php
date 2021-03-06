<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Units_model extends CI_Model {
  private $table  = 'units';
  private $odometer_logs  = 'units_odometer_logs';
  public $fields  = 'u.*, d.*, u.id unit_id, d.id driver_id, u.status unit_status, d.status driver_status';

  public $user_id;

  function __construct(){
    parent::__construct();
  }

  public function read( $filter = array(), $limit = null, $offset = null, $sort = array(), $one = false ) {
    if( count($filter) )
      $this->db->filter( $filter );

    if( count( $sort ) )
      $this->db->order_by( $sort['field'], $sort['direction'] );
    
    return $this->db
                ->select( $this->fields )
                ->where( 'u.deleted_at IS NULL', null, false )
                ->join( 'drivers d', 'd.unit_id = u.id', 'left' )
                ->group_by( 'u.id' )
                ->get( $this->table.' u' );
  }

  public function create( $db_data ) {
    $date_fields = array(
                           'resealing_date1'
                          ,'resealing_date2'
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

    return $this->db->affected_rows();
  }

  public function update( $db_data ) {
  	$db_data['updated_at'] = date('Y-m-d H:i:s');
  	
    $date_fields = array(
                           'resealing_date1'
                          ,'resealing_date2'
    					            ,'registration_date'
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
    unset($db_data['driver_id']);

    if( isset($db_data['unit_id']) )
    {
      $this->db->where( 'id', $db_data['unit_id'] );
      unset($db_data['unit_id']);
    }

    if( isset( $db_data['resealing_date1'] ) )
    {
      for ($i=0; $i < count($date_fields); $i++)
        $db_data[$date_fields[$i]] = dateFormat( $db_data[$date_fields[$i]] );
    }

    $this->db->update( $this->table, $db_data );

    return $this->db->affected_rows();
  }

  # update unit status
  public function update_status( $unit_id, $status = UNIT_DUTY )
  {
    $this->db
         ->where( 'id', $unit_id )
         ->update( $this->table, array( 'status' => $status ) );

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
    $check = $this->db->where( 'driver_idFK', $data['driver_idFK'])->where( 'unit_idFK', $data['unit_idFK'] )->count_all_results('units_logs');
    if( $check > 0 )
      return false;

    $this->db->insert('units_logs', $data);
    return $this->db->affected_rows();
  }
  
  # Get units schedules
  public function get_schedules( $from, $to ) {
  	return $this->db
  				->select( 'id, plate_number, resealing_date1, resealing_date2, franchise_until, renew_by' )
  				->where( 'resealing_date1 >=', $from)
  				->where( 'resealing_date1 <=', $to)
  				->where( 'resealing_date2 >=', $from)
  				->where( 'resealing_date2 <=', $to)
  				->where( 'franchise_until >=', $from)
  				->where( 'franchise_until <=', $to)
  				->where( 'renew_by >=', $from)
  				->where( 'renew_by <=', $to)
  				->get( $this->table );
  }

  # archive unit
  public function archive( $unit_id )
  {
  	$now = date('Y-m-d H:i:s');
  	
    $this->db
         ->where( 'id', $unit_id )
         ->update( $this->table, array( 'deleted_at' => $now ) );

    return $this->db->affected_rows();
  }

  # Logs odometer
  public function log_odometer( $unit_id, $odometer )
  {
    $now = date('Y-m-d H:i:s');
    
    $this->db->insert( $this->odometer_logs, array( 'unit_id' => $unit_id, 'odometer' => $odometer, 'created_by' => $this->user_id, 'created_at' => $now ) );

    return $this->db->affected_rows();
  }
  
}