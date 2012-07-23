<?php

class MY_Controller extends CI_Controller
{

    protected $data;

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('usr_session')) {
            redirect('login');
        } else if (is_null($this->data)) {
            $session = $this->session->all_userdata();
            $this->data = $session['usr_session'];
        }
    }

}
