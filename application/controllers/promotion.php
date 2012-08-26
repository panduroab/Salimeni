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
     * Agrega una promocion en la base de datos
     */
    public function add()
    {
        //Se envio el $_POST
        if (isset($_POST['place'])) {
            //Se crea el array con los datos
            $promotion = array(
                'promotion' => '',
                'name' => $_POST['name'],
                'details' => $_POST['details'],
                'startAt' => $_POST['startAt'] . ' ' . $_POST['startAtTime'],
                'endsAt' => $_POST['endsAt'] . ' ' . $_POST['endsAtTime'],
                'class' => $_POST['class'],
                'type' => $_POST['type'],
                'day' => '',
                'url' => url_title($_POST['name']) . '.html',
                'category' => $_POST['category'],
                'subcategory' => NULL
            );
            if ($promotion['type'] == 'repeat') {
                //Obiene los dias
                $dia[0] = isset($_POST['lunes']) ? '0,' : '';
                $dia[1] = isset($_POST['martes']) ? '1,' : '';
                $dia[2] = isset($_POST['miercoles']) ? '2,' : '';
                $dia[3] = isset($_POST['jueves']) ? '3,' : '';
                $dia[4] = isset($_POST['viernes']) ? '4,' : '';
                $dia[5] = isset($_POST['sabado']) ? '5,' : '';
                $dia[6] = isset($_POST['domingo']) ? '6,' : '';
                foreach ($dia as $value) {
                    $promotion['day'] .= $value;
                }
            }
            //Se inserta en la base de datos y se obtiene el id
            $result = $this->promotionmodel->addPromotion($promotion);
            //Se inserta la relacion de mapPlacePromotion
            $this->promotionmodel->addMapPlacePromotion(
                    array('place' => $_POST['place'], 'promotion' => $result));
            //Se redirecciona al panel del lugar
            redirect('place/view/' . $_POST['place']);
        } else {
            //Se carga el form
            //Obtiene las categorias
            $this->data['categorias'] = $this->categorymodel->getCategory();
            //Obtiene el id del lugar
            $place = $this->uri->segment(3) != 0 ? $this->uri->segment(3) : 0;
            //Comprueba si el lugar es del usuario
            $result = $this->placemodel->getPlaceUser($this->data['user'], $place);
            if (count($result) > 0 || $this->data['type'] == "admin") {
                //Si es el lugar le pertenece al usuario o es administrador
                $this->data['place'] = $place;
                $this->load->view('common/header', $this->data);
                $this->load->view('common/adminMenu');
                $this->load->view('promotion/agregarPromocion', $this->data);
                $this->load->view('common/footer');
            } else {
                //Si el lugar no pertenece al usuario se regresa al administrador
                redirect('admin');
            }
        }
    }

    /**
     * Actualiza una promocion en la base de datos
     */
    public function update()
    {
        //Se envio el $_POST?
        if (isset($_POST['promotion'])) {
            //Se actualiza la promocion
            //Se crea el array con los datos
            $promotion = array(
                'name' => $_POST['name'],
                'details' => $_POST['details'],
                'startAt' => $_POST['startAt'] . ' ' . $_POST['startAtTime'],
                'endsAt' => $_POST['endsAt'] . ' ' . $_POST['endsAtTime'],
                'class' => $_POST['class'],
                'type' => $_POST['type'],
                'day' => '',
                'url' => url_title($_POST['name']) . '.html',
                'category' => $_POST['category'],
                'subcategory' => NULL
            );
            if ($promotion['type'] == 'repeat') {
                //Obiene los dias
                $dia[0] = isset($_POST['lunes']) ? '0,' : '';
                $dia[1] = isset($_POST['martes']) ? '1,' : '';
                $dia[2] = isset($_POST['miercoles']) ? '2,' : '';
                $dia[3] = isset($_POST['jueves']) ? '3,' : '';
                $dia[4] = isset($_POST['viernes']) ? '4,' : '';
                $dia[5] = isset($_POST['sabado']) ? '5,' : '';
                $dia[6] = isset($_POST['domingo']) ? '6,' : '';
                foreach ($dia as $value) {
                    $promotion['day'] .= $value;
                }
            }
            //Se inserta en la base de datos y se obtiene el id
            $this->promotionmodel->updatePromotion($promotion, $_POST['promotion']);
            //Se inserta la relacion de mapPlacePromotion
            redirect('place/view/' . $_POST['place']);
        } else {
            //Se muestra el form con los datos
            //Id de la promocion
            $promotion = $this->uri->segment(3) != 0 ? $this->uri->segment(3) : 0;
            //Analiza el tipo de usuario
            if ($this->data['type'] == 'admin') {
                //Si es administrador lo obtiene sin importar que no sea de el
                $this->data['promotion'] = $this->promotionmodel->
                        getPromotion(array('promotion' => $promotion));
            } else if ($this->data['type'] == 'client') {
                //Obtiene el promotion que le pertenece al usuario
                $this->data['promotion'] = $this->promotionmodel->
                        getPromotionUser($promotion, $this->data['user']);
            }
            //Se agregan las categorias
            $this->data['categorias'] = $this->categorymodel->getCategory();
            if ($this->data['promotion'] != NULL) {
                //Si hay informacion se abre el form
                $this->load->view('common/header', $this->data);
                $this->load->view('common/adminMenu');
                $this->load->view('promotion/update');
                $this->load->view('common/footer');
            } else {
                //No hay informacion
                redirect('admin');
            }
        }
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
