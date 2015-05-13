<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Units extends MY_Framework
{
    function __construct()
    {
        parent::__construct();
    }

    public function index( )
    {
        $this->tsdata['nav']        = 'units';
        $this->tsdata['sub_nav']    = 'all_units';
        $this->load_view( 'all_units' );
    }

}