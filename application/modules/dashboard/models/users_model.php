<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
	private $table = 'users';

    function __construct(){
        parent::__construct();
    }

    public function read($filter = array(), $limit = null, $offset = null, $one = false) {
    	if( count($filter) )
    		$this->db->filter( $filter );

    	return $this->db
                    ->get( $this->table );
    }

  //   public function create( $type, $db_data ) {
		// $data = $this->_process($type, $db_data);

  //   	if( $this->add( $data['table'], $data['db_data'] ) )
  //   		return true;
  //   	else
  //   		return false;
  //   }

  //   public function update( $type, $db_data ) {
		// $data = $this->_process($type, $db_data);
		
		// if( isset( $db_data['template_idFK'] ) ){
		// 	$id		= $db_data['template_idFK'];
		// 	$field	= 'template_idFK';
		// 	unset($db_data['template_idFK']);
		// } elseif( isset( $db_data['template_id'] ) ) {
		// 	$id		= $db_data['template_id'];
		// 	$field  = 'template_id';
		// 	unset( $db_data['template_id'] );
		// }

  //   	if( $this->edit( $data['table'], $data['db_data'], $field, $id ) )
  //   		return true;
  //   	else
  //   		return false;
  //   }
}