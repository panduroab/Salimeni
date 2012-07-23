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
        $this->load->view('promotion/agregarPromocion');
    }

    /**
     * Llama la funcion addPromotion del modelo
     */
    public function addPromotion()
    {
        $this->promotionmodel->addPromotion();
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
