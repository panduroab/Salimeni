<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Esta clase no necesita login, es donde todo mundo puede explorar los
 * lugares 
 */
class main extends CI_Controller
{

    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->data['category'] = $this->categorymodel->getCategory();
    }

    public function index()
    {
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('main/index');
        $this->load->view('common/footer');
    }

    /**
     * Funcion que muestra todos los eventos mas proximos
     */
    public function now()
    {
        $category = isset($_GET['category']) && $_GET['category'] != NULL ? $_GET['category'] : NULL;
        $time = date('Y-m-d H:i:s', time());
        $this->data['promotion'] = $this->promotionmodel->
                getMainPromo(NULL, $time, $category);
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('main/now');
        $this->load->view('common/footer');
    }

    /**
     * Funcion que muestra los detalles de una promocion
     */
    public function promotionDetails()
    {
        //Agregar un filtro, si la fecha de expiracion ya paso, ya no mostrar
        //la promocion.
        $promotion = isset($_GET['promotion']) && $_GET['promotion'] != NULL ? $_GET['promotion'] : 0;
        $this->data['promotion'] = $this->promotionmodel->getMainPromo($promotion, NULL, NULL);
        $this->data['images'] = $this->imagemodel->getImage(array('table' => 'mapImagePromotion', 'id' => $promotion, 'column' => 'promotion'));
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('main/promotionDetails');
        $this->load->view('common/footer');
    }

    /**
     * Funcion que muestra los detalles de una promocion
     */
    public function promocion()
    {
        $promotion = $this->uri->segment(3) != 0 ? $this->uri->segment(3) : 0;
        $this->data['promotion'] = $this->promotionmodel->getMainPromo($promotion, NULL, NULL);
        $this->data['images'] = $this->imagemodel->getImage(array('table' => 'mapImagePromotion', 'id' => $promotion, 'column' => 'promotion'));
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('main/promotionDetails');
        $this->load->view('common/footer');
    }

    /**
     * Funcion que muestra los detalles de un lugar
     */
    public function placeDetails()
    {
        $place = isset($_GET['place']) && $_GET['place'] != NULL ? $_GET['place'] : 0;
        $this->data['place'] = $this->placemodel->getPlace(array('place' => $place), NULL);
        $this->data['images'] = $this->imagemodel->getImage(array('table' => 'mapImagePlace', 'id' => $place, 'column' => 'place'));
        $this->data['promotions'] = $this->promotionmodel->getPromotionPlace($place);
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('main/placeDetails');
        $this->load->view('common/footer');
    }

    /**
     * Funcion que muestra los detalles de un lugar
     */
    public function lugar()
    {
        $place = $this->uri->segment(3) != 0 ? $this->uri->segment(3) : 0;
        $this->data['place'] = $this->placemodel->getPlace(array('place' => $place), NULL);
        $this->data['images'] = $this->imagemodel->getImage(array('table' => 'mapImagePlace', 'id' => $place, 'column' => 'place'));
        $this->data['promotions'] = $this->promotionmodel->getPromotionPlace($place);
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('main/placeDetails');
        $this->load->view('common/footer');
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

    /**
     * Funcion que muestra todos los lugares o muestra los lugares por
     * categorias
     */
    public function places()
    {
        if (isset($_GET['category']) && !is_null($_GET['category'])) {
            $category = array('category' => $_GET['category']);
            $this->data['places'] = $this->placemodel->getPlace(NULL, $category);
        } else {
            $this->data['places'] = $this->placemodel->getPlace();
        }
        $this->load->view('common/header', $this->data);
        $this->load->view('common/menu');
        $this->load->view('main/places');
        $this->load->view('common/footer');
    }

    /**
     * Funcion que hace la busqueda de lugares o promociones de acuerdo al filtro
     */
    public function search()
    {
        $json = '';
        $word = $_POST['searchword'];
        //$word = $_GET['searchword'];
        $search = $this->uri->segment(3) != 0 ? $this->uri->segment(3) : 0;
        if ($search == 'place') {
            $json = $this->placemodel->search($word);
        } else if ($search == 'promotion') {
            $json = $this->promotionmodel->search($word);
        }
        echo json_encode($json);
    }

}