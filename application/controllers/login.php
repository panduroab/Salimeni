<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('usr_session')) {
            redirect('main');
        }
    }

    /**
     * Muestra la vista del login
     */
    public function index()
    {
        $this->load->view('login/index');
    }

    /**
     * Funcion del login 
     */
    public function entrar()
    {
        $this->load->model('loginmodel');
        $login = array();
        if (isset($_POST['email']) && isset($_POST['password']) &&
                !is_null($_POST['email']) && !is_null($_POST['password'])) {
            $login['email'] = $_POST['email'];
            $login['password'] = md5($_POST['password']);
            $result = $this->loginmodel->login($login);
            if ($result['result'] == TRUE) {
                //Los datos coincidieron y se crea la session
                unset($result['password']);
                $this->session->set_userdata('usr_session', $result);
                redirect('main');
            } else {
                //Los datos NO coincidieron, NO se crea la session
                $this->load->view('login/index', array('error' => TRUE));
            }
        } else {
            $this->load->view('login/index', array('error' => TRUE));
        }
    }

}