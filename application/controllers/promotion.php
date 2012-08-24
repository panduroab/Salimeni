<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promotion extends MY_Controller
{

    /**
     * Carga el modelo que se necesita
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('promotionmodel');
    }

    /**
     * Muestra la vista de agregarPromocion
     */
    public function agregarPromocion()
    {
        //Obtiene las categorias
        $this->data['categorias'] = $this->categorymodel->getCategory();
        //Le paso a la vista los datos de usuario y las categorias
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('promotion/agregarPromocion');
        $this->load->view('common/footer');
    }

    /**
     * Llama la funcion addPromotion del modelo
     */
    public function addPromotion()
    {
        //Se crea el array con los datos
        $promotion = array(
            'promotion' => '',
            'name' => $_POST['name'],
            'details' => $_POST['details'],
            'createdAt' => $_POST['createdAt'],
            'startAt' => $_POST['startAt'],
            'endsAt' => $_POST['endsAt'],
            'class' => $_POST['class'],
            'type' => $_POST['type'],
            'day' => $_POST['day'],
            'url' => url_title($_POST['name']) . '.html',
            'category' => $_POST['category'],
            'subcategory' => $_POST['subcategory']
        );
        //Se inserta en la base de datos y se obtiene el id
        $result = $this->promotionmodel->addPromotion($promotion);
        //Se inserta la relacion de mapPlacePromotion
        $this->promotionmodel->addMapPlacePromotion(
                array('place' => $_POST['place'], 'promotion' => $result));
    }

    /**
     * Muestra una promocion
     */
    public function getPromotion()
    {
        if (isset($_GET['promotion']) && $_GET['promotion'] != NULL) {
            $promotion = array('promotion' => $_GET['promotion']);
            $var = $this->promotionmodel->getPromotion($promotion);
        } else {
            $var = $this->promotionmodel->getPromotion();
        }
        var_dump($var);
    }

    /**
     * Muestra las promociones de un lugar 
     */
    public function getPromotionPlace()
    {
        if (isset($_GET['place']) && $_GET['place'] != NULL) {
            $place = $_GET['place'];
            $promociones = $this->promotionmodel->getPromotionPlace($place);
            var_dump($promociones);
        }
    }

}
