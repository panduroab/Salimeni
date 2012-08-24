<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Place extends MY_Controller {

    /**
     * Inicializa el padre  
     * Carga el modelo 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('placemodel');
        $this->load->model('categorymodel');
    }

    /**
     * Muestra todos los lugares del usuario
     */
    public function index() {
        //Comprueba que tipo de usuario
        $type = $this->data['type'];
        if ($type == 'admin') {
            //Muestra todos los lugares con sus respectivos usuarios
            $this->data['lugares'] = $this->placemodel->getPlace();
            var_dump($this->data['lugares']);
        } else if ($type == 'client') {
            //Muestra todos los lugares del usuarios
            $this->data['lugares'] = $this->placemodel->getPlaceUser($this->data['user']);
            var_dump($this->data['lugares']);
        }
    }

    /**
     * Muestra la vista de agregar Lugar 
     */
    public function agregarLugar() {
        //Obtiene las categorias
        $this->data['categorias'] = $this->categorymodel->getCategory();
        //Le paso a la vista los datos de usuario y las categorias
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('place/agregarLugar');
        $this->load->view('common/footer');
    }

    /**
     * Agrega un lugar a la base de datos 
     */
    public function addPlace() {
        // Se crea el array
        $place = array(
            'place' => '',
            'name' => $_POST['name'],
            'details' => $_POST['details'],
            'latitude' => $_POST['latitude'],
            'longitude' => $_POST['longitude'],
            'country' => $_POST['country'],
            'state' => $_POST['state'],
            'city' => $_POST['city'],
            'colony' => $_POST['colony'],
            'zipCode' => $_POST['zipCode'],
            'street' => $_POST['street'],
            'number' => $_POST['number'],
            'url' => url_title($_POST['name']) . '.html',
            'category' => $_POST['category']
        );
        //Inserta los datos en la base de datos
        $lugar = $this->placemodel->addPlace($place);
        //Agregar mapUserPlace
        $this->addMapUserPlace($_POST['user'], $lugar, $this->data['type']); //Post para pruebas
        //var_dump($result);
        redirect('place/getPlace.html?place=' . $lugar);
    }

    /**
     * Muestra todos los detalles de un lugar (imagenes, promociones)
     * Con las opciones de editar todo y agregar imagenes y promociones
     */
    public function getPlace() {
        //Obtiene los parametros de la busqueda
        $place = isset($_GET['place']) && $_GET['place'] != NULL ? $_GET['place'] : NULL;
        //Obtiene el place que le pertenece al usuario
        $this->data['place'] = $this->placemodel->
                getPlaceUser($this->data['user'], $place);
        //Obtuvo lugar?
        if ($this->data['place'] != NULL) {
            //Muestra las imagenes del lugar señalado
            $this->data['images'] = $this->imagemodel->getImage(array('table' => 'mapImagePlace', 'id' => $place, 'column' => 'place'));
            $this->data['promotions'] = $this->promotionmodel->getPromotionPlace($place);
        } else {
            redirect('admin');
        }
        //Se envia la informacion a la vista para que se imprima la lista
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('admin/placeDetails');
        $this->load->view('common/footer');
    }

    /**
     * Agrega la relacion entre el lugar y el usuario
     * @param type $user
     * @param type $place 
     */
    private function addMapUserPlace($user, $place, $type) {
        $mapUserPlace = array('user' => $user, 'place' => $place, 'type' => $type);
        $this->placemodel->addMapUserPlace($mapUserPlace);
    }

}