<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Muestra el menu principal del Administrador
     * Si es admin->Lista de todos los Clientes
     * Si es cliente->Lista de todos sus Lugares
     */
    public function index()
    {
        //Revisa el tipo de usuario que es
        switch ($this->data['type']) {
            case 'admin':
                //Administrador manda la lista de los clientes
                $this->data['users'] = $this->usermodel->getUser();
                break;
            case 'client':
                //Cliente manda la lista de sus lugares
                $this->data['places'] = $this->placemodel->
                        getPlaceUser($this->data['user']);
                break;
        }
        //Se envia la informacion a la vista para que se imprima la lista
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('admin/index');
        $this->load->view('common/footer');
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
