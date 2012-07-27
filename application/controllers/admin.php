<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('admin/index');
    }

    public function today()
    {
        $this->load->library('Calendar');
        $calendario = $this->calendar->generate();
        echo $calendario;
    }

    /**
     * Se elimina la session y se redirije al login 
     */
    public function logout()
    {
        $this->session->unset_userdata('usr_session');
        $this->data = NULL;
        redirect('main');
    }

}
