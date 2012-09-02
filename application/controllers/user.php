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
     * Agrega usuarios a la base de datos
     */
    public function add()
    {
        if ($this->data['type'] == 'admin') {
            if (isset($_POST['type'])) {
                $user = array(
                    'user' => '',
                    'name' => $_POST['name'],
                    'lastName' => $_POST['lastName'],
                    'email' => $_POST['email'],
                    'password' => md5($_POST['password']),
                    'type' => $_POST['type'],
                    'status' => $_POST['status']
                );
                //Insertar los datos en la base de datos
                $usuario = $this->usermodel->addUser($user);
                //Redirecciona a la cuenta del usuario
                redirect('user/account/' . $usuario);
            } else {
                $this->load->view('common/header');
                $this->load->view('common/adminMenu');
                $this->load->view('user/agregarUsuario');
                $this->load->view('common/footer');
            }
        } else {
            redirect('admin');
        }
    }

    /**
     * 
     */
    public function update()
    {
        if ($this->data['type'] == 'admin') {
            if (isset($_POST['user'])) {
                $userdata = array(
                    'name' => $_POST['name'],
                    'lastName' => $_POST['lastName'],
                    'email' => $_POST['email'],
                    'type' => $_POST['type'],
                    'status' => $_POST['status']
                );
                //Se actualiza el usuario
                $this->usermodel->updateUser($_POST['user'], $userdata);
                //Se redirige
                redirect('user/account/' . $_POST['user']);
            } else {
                $user =
                        $this->uri->segment(3) != 0 ?
                        $this->uri->segment(3) : 0;
                //Obtengo los datos del usuario a editar
                $this->data['userAccount'] =
                        $this->usermodel->getUser(array('user' => $user));
                $this->load->view('common/header', $this->data);
                $this->load->view('common/adminMenu');
                $this->load->view('user/update');
                $this->load->view('common/footer');
            }
        } else {
            redirect('admin');
        }
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