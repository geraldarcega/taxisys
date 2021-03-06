<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/*
	* General helper
	* file: helper/general_helper.php
	*/

	function dashboard_url( $uri = '' ) {
		return base_url('dashboard/'.$uri);
	}

	function pos_url( $uri = '' ) {
		return base_url('pos/'.$uri);
	}

	function getSession( ) {
		$ci =& get_instance();

		$user_data = $ci->session->userdata('user_info');
		if( $user_data )
			return $user_data;
		else
		{
// 			$ci->load->library('user_agent');
// 			if( $ci->agent->is_referral() )
// 				$ci->session->set_userdata('r', urlencode($ci->agent->referrer()));

			if( uri_string() != 'pos/login' )
        		redirect( pos_url('login') );
		}
	}

	# If $bread is null, breadcrumbs will be the uri segments
	function getBreadcrumbs( $module = '', $bread = null ) {
		$ci =& get_instance();
		$_bread = array( 'Home' => base_url() );

		if( is_null( $bread ) ) {
			$seg = $ci->uri->segment_array();

			foreach ($seg as $key => $uri) {
				$prefix = $uri != $module ? $module.'/'.$uri : $uri; 
				$_uri = count( $seg ) != $key ? base_url( $prefix ) : "";
				$_bread[ ucwords(replaceSpecialChar( $uri )) ] = $_uri;
			}
			return $_bread;
		}
	}

	# Default $replace is "space"
	function replaceSpecialChar( $str, $replace = ' ' ){
		$special_char = array(
								 '-'
								,'_'
							 );
		return str_replace($special_char, $replace, $str);
	}

	function hashPassword( $password ){
		return md5($password.PASS_SALT);
	}

	function debug() {
		$params = func_get_args();
		if( count( $params ) > 0 ) {
			for ($i=0; $i < count($params); $i++) { 
				echo "<pre>";print_r($params[$i]);echo "</pre>";
			}
		}
	}

	function singular_plural( $count ) {
		return $count > 1 ? 's' : '';
	}

	function upload_img( $save_path ) {
		$ci =& get_instance();

		$config['upload_path']	 = FCPATH.$save_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']		 = '10240';
		$config['max_width'] 	 = '0';
		$config['max_height'] 	 = '0';

		$ci->load->library('upload');
		if( count($_FILES) > 0 ){
			foreach ($_FILES as $fieldname => $fileObject)
			{
			    if (!empty($fileObject['name']))
			    {
					$config['file_name'] = md5(time().rand(0,20))."_".rand(0,100);
			        $ci->upload->initialize($config);
			        if (!$ci->upload->do_upload($fieldname))
			        {
			            $msg = array('success' => 0, 'msg' => $ci->upload->display_errors());
			        }
			        else
			        {
			        	$msg = array('success' => 1, 'msg' => $ci->upload->data() );
			        }
		        }
	        }
		}

		return $msg;
	}

	function resize_img( $image, $h, $w, $source, $save_path ) {
		$ci =& get_instance();

		$ci->load->library('image_lib');

		$config['image_library'] 	= 'gd2';
		$config['source_image']  	= $source.$image;
		$config['new_image']		= $save_path.$image;
		$config['width']			= $w;
		$config['height']			= $h;

		$ci->image_lib->initialize($config);
		if ( ! $ci->image_lib->resize())
			return false;

		$ci->image_lib->clear();
		return true;
	}

	# Default mysql date format
	function dateFormat( $date, $format = 'Y-m-d' ) {
		return date($format, strtotime($date));
	}

	# Show readable unit status
	function unitStatus( $stats ) {
		$status = array( UNIT_DUTY => 'On-duty', UNIT_GARAGE => 'On-garage', UNIT_MAINTENANCE => 'Maintenance', UNIT_REPLACED => 'Replaced' );
		return @$status[ $stats ];
	}

	# Show readable coding day
	function codingDay( $day ) {
		$coding = array( DAY_MON => 'Monday', DAY_TUE => 'Tuesday', DAY_WED => 'Wednesday', DAY_THUR => 'Thursday', DAY_FRI => 'Friday' );
		return @$coding[ $day ];
	}

	# Show readable driver status
	function driverStatus( $stats ) {
		$on_duty = array( DRIVER_DUTY => 'Yes', DRIVER_OFF => 'No' );
		return @$on_duty[ $stats ];
	}

	# get unit wrapper by status
	function unitStatusWrapper( $stats ) {
		$status = array( UNIT_DUTY => 'duty_wrapper', UNIT_GARAGE => 'garage_wrapper', UNIT_MAINTENANCE => 'maintenance_wrapper' );
		return @$status[ $stats ];
	}

	# get unit class by status
	function unitStatusClass( $stats ) {
		$status = array( UNIT_DUTY => 'panel-green', UNIT_GARAGE => 'panel-yellow', UNIT_MAINTENANCE => 'panel-red' );
		return @$status[ $stats ];
	}

	# get maintenance interval
	function maintenanceInterval( $type ) {
		$interval = array( 1 => 'Odometer', 2 => 'Month/s', 3 => 'Week/s' );
		return @$interval[ $type ];
	}

	# setup pagination
	function setup_pagination( $base_url, $query_string = false, $total = 0, $page = 0, $limit = LIMIT,  $uri_segment = 3, $num_links = 3 ) 	{
		$ci =& get_instance();
		$ci->load->library('pagination');

		if( !$query_string )
			$config['uri_segment'] = $uri_segment;
		else
			$config['query_string_segment'] = 'page';

		$config['base_url'] = $base_url;
		$config['page_query_string'] = $query_string;
		$config['base_url'] = $base_url;
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['num_links'] = $num_links;
		$config['full_tag_open'] = '<ul class="pull-right pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

		$ci->pagination->initialize($config); 

		return $ci->pagination->create_links();
	}
?>
