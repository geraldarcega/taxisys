<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Drivers extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('drivers_model');
        $this->load->model('units_model');
    }

    public function index( )
    {
        $filter = array();
        $limit = LIMIT;
        $page = $this->input->get('page') ? $this->input->get('page') : 0;
        $baseurl = dashboard_url($this->_class).'?';

        if( !empty($_GET) )
        {
            $uri = array();
            foreach ($_GET as $key => $value) {
                if( $key != 'page' )
                    $uri[] = $key.'='.$value;
            }
            $baseurl .= implode('&', $uri);
        }

        if( $this->input->get('search') )
        {
            switch ($this->input->get('column')) {
                case 'name':
                    $filter = array('lk|first_name' => $this->input->get('search'), 'or_lk|last_name' => $this->input->get('search'), 'or_lk|nickname' => $this->input->get('search'));
                    break;
                
                case 'plate_number':
                    if( $this->input->get('search') != '' )
                        $filter = array('lk|plate_number' => $this->input->get('search'));
                    else
                        $filter = array('wh|plate_number' => null);
                    break;
                
                default:
                    $filter = array('wh|d.status' => $this->input->get('search'));
                    break;
            }
        }


        if( $this->input->get('limit') ) $limit = $this->input->get('limit') != 'all' ? $this->input->get('limit') : null;

        $this->data['drivers']     = $this->drivers_model->read( $filter, $limit, $page );
        $this->data['avail_units'] = $this->units_model->read( );

        $this->data['pagination'] = setup_pagination(
             $baseurl
            ,true
            ,$this->drivers_model->count( $filter )
            ,$page
            ,$limit
        );

        $this->load_view( 'index' );
    }

    public function ajax()
    {
        if( $this->input->is_ajax_request() )
        {
            switch ( $this->input->post( 'action' ) ) {
                case 'create':
                    $new = $this->drivers_model->create( $this->input->post() );
                    if( !isset($new['exist']) )
                    {
                        // $this->units_model->create_log( array( 'unit_idFK' => $this->input->post('unit'), 'driver_idFK' => $new ) );
                        $this->session->set_flashdata('msg', array( 'text' => '<strong><i class="fa fa-database"></i> Success!</strong> New driver has been created.', 'class' => 'alert-success' ));
                        $msg = array( 'success' => 1 );
                    }
                    else
                        $msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> Driver '.$this->input->post('fname').' '.$this->input->post('lname').' is already exists.' );

                    echo json_encode( $msg );
                    break;
                case 'update':
                    $update = $this->drivers_model->update( $this->input->post() );
                    if( !isset($update['exist']) )
                    {
//                         $this->units_model->create_log( array( 'unit_idFK' => $this->input->post('unit'), 'driver_idFK' => $this->input->post('driver_id') ) );
                        $this->session->set_flashdata('msg', array( 'text' => '<strong><i class="fa fa-database"></i> Success!</strong> Driver\'s details is now updated.', 'class' => 'alert-success' ));
                        $msg = array( 'success' => 1 );
                    }
                    else
                        $msg = array( 'success' => 0, array( 'text' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> Driver '.$this->input->post('fname').' '.$this->input->post('lname').' is already exists.', 'class' => 'alert-success' ) );

                    echo json_encode( $msg );
                    break;

				case 'remove':
					$remove = $this->drivers_model->update( $this->input->post() );
					if( !isset($$remove['exist']) )
					{
						$this->session->set_flashdata('msg', array( 'text' => '<strong><i class="fa fa-database"></i> Success!</strong> '.$this->input->post('full_name').' has been '.($this->input->post('archived') ? 'archived' : 'removed'), 'class' => 'alert-success' ));
						$msg = array( 'success' => 1 );
					}
					else
						$msg = array( 'success' => 0, 'msg' => '<strong><i class="fa fa-exclamation-triangle"></i> Ooops!</strong> Driver '.$this->input->post('fname').' '.$this->input->post('lname').' is already exists.' );
					                    
					echo json_encode( $msg );
					
					break;
                default:
                    # code...
                    break;
            }
        }
        else
            redirect( dashboard_url(), '301' );
    }
}