<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('main/index');
    }

    public function today()
    {
        $this->load->library('Calendar');
        $calendario = $this->calendar->generate();
        echo $calendario;
    }
    
    
}
