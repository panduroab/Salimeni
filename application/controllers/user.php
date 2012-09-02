<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller
{

    /**
     * Inicializa el constructor del padre
     * Carga el modelo
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usermodel');
    }

    /**
     * Muestra la vista de agregarUsuario
     */
    public function agregarUsuario()
    {
        $this->load->view('user/agregarUsuario');
    }

    /**
     * Recibe los datos y agrega al usario a la base de datos
     * Muestra al usuario agregado
     */
    public function addUser()
    {
        //Hay que checar como hacer la validacion y reglas de los campos con CI
        //Obtengo los datos que me mandaron por post
        $user = array(
            'user' => '',
            'name' => $_POST['name'],
            'lastName' => $_POST['lastName'],
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
            'type' => $_POST['type']
        );
        //Insertar los datos en la base de datos
        $usuario = $this->usermodel->addUser($user);
        //Se obtiene el usuario insertado
        $result = $this->usermodel->getUser(array('user' => $usuario));
        var_dump($result);
    }

    /**
     * Muestra un usuario 
     */
    public function getUser()
    {
        if (isset($_GET['user']) && $_GET['user'] != NULL) {
            $user = array('user' => $_GET['user']);
            $var = $this->usermodel->getUser($user);
        } else {
            $var = $this->usermodel->getUser();
        }
        var_dump($var);
    }

    /**
     * Devuelve los datos completos del usuario y sus lugares
     */
    public function account()
    {
        switch ($this->data['type']) {
            case 'admin'://Admin puede verse a si mismo o a otro user
                $user = $this->uri->segment(3) != 0 ? $this->uri->segment(3) : $this->data['user'];
                break;
            case 'client'://El cliente solo se ve a si mismo
                $user = $this->data['user'];
                break;
        }
        //Obtiene los datos del usuario
        $this->data['account'] =
                $this->usermodel->getUser(array('user' => $user));
        //Obtiene los lugares del usuario
        $this->data['places'] =
                $this->placemodel->getPlaceUser($user);
        //Envia los datos a la vista
        $this->load->view('common/header', $this->data);
        $this->load->view('common/adminMenu');
        $this->load->view('admin/userAccount');
        $this->load->view('common/footer');
    }

}