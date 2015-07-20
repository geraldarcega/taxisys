<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendar extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
    }

    public function index( )
    {
        $this->data['nav'] = 'calendar';
        $this->top_nav = false;
        $this->load_view( 'index' );
	}

}