<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Esta clase no necesita login, es donde todo mundo puede explorar los
 * lugares 
 */
class main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('promotionmodel');
    }

    public function index()
    {
        $this->load->view('main/index');
    }

    /**
     * Funcion que muestra todos los eventos mas proximos
     */
    public function now()
    {
        $category = isset($_GET['category']) && $_GET['category'] != NULL ? $_GET['category'] : NULL;
        $time = date('Y-m-d h:i:s', time());
        $data['promotion'] = $this->promotionmodel->getNowPromotions($time, $category);
        $this->load->view('main/now', $data);
    }

    /**
     * Funcion que muestra los detalles de una promocion
     */
    public function promotionDetails()
    {
        $promotion = isset($_GET['promotion']) && $_GET['promotion'] != NULL ? $_GET['promotion'] : 0;
        $data = $this->promotionmodel->getPromotionDetails($promotion);
        $this->load->view('main/promotionDetails', $data);
    }

    /**
     * Funcion que muestra todos los eventos mas cercanos 
     */
    public function here()
    {
        
    }

    /**
     * Function que muestra la exploracion de los lugares 
     */
    public function explore()
    {
        
    }

}