<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Place extends MY_Controller
{

    /**
     * Inicializa el padre  
     * Carga el modelo 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('placemodel');
    }

    /**
     * Muestra la vista de agregar Lugar 
     */
    public function agregarLugar()
    {
        $data = array('user' => $_GET['user']); //Para pruebas
        $this->load->view('place/agregarLugar', $data);
    }

    /**
     * Agrega un lugar a la base de datos 
     */
    public function addPlace()
    {
        //Obtiene las categorias
        $categorias = '';
        $category = array('restaurant', 'bar', 'antro', 'culture', 'sport');
        foreach ($category as $value)
            $categorias .= isset($_POST[$value]) ? $value . ',' : '';
        //Obtiene las demas categorias
        $place = array(
            'place' => '',
            'name' => $_POST['name'],
            'details' => $_POST['details'],
            'adresse' => $_POST['adresse'],
            'latitude' => $_POST['latitude'],
            'longitude' => $_POST['longitude'],
            'category' => $categorias
        );
        //Inserta los datos en la base de datos
        $lugar = $this->placemodel->addPlace($place);
        //Se obtiene el lugar insertado
        $result = $this->placemodel->getPlace(array('place' => $lugar));
        //Agregar mapUserPlace
        $this->addMapUserPlace($_POST['user'], $lugar); //Post para pruebas
        var_dump($result);
    }

    /**
     * Muestra un lugar 
     */
    public function getPlace()
    {
        if (isset($_GET['place']) && $_GET['place'] != NULL) {
            $place = array('place' => $_GET['place']);
            $var = $this->placemodel->getPlace($place);
        } else {
            $var = $this->placemodel->getPlace();
        }
        var_dump($var);
    }

    /**
     * Agrega la relacion entre el lugar y el usuario
     * @param type $user
     * @param type $place 
     */
    private function addMapUserPlace($user, $place)
    {
        $mapUserPlace = array('user' => $user, 'place' => $place);
        $this->placemodel->addMapUserPlace($mapUserPlace);
    }

    /**
     * Obtiene los lugares del user
     */
    public function getPlaceUser()
    {
        if (isset($_GET['user']) && $_GET['user'] != NULL) {
            $user = $_GET['user'];
            $lugares = $this->placemodel->getPlaceUser($user);
            var_dump($lugares);
        }
    }

}