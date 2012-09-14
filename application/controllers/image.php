<?php

class Image extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        if (isset($_POST['tableItem'])) {
            //Subir la imagen
            $path = $_POST['tableItem'] == 'place' ?
                    'application/views/assets/place/img/' :
                    'application/views/assets/promotion/img/';
            if (isset($_FILES['photoimg'])) {
                $data = $this->imagemodel->upload($path, 'photoimg');
                //Cambiar el tamaño de la imagen y crear miniaturas
                $image_name = $this->imagemodel->resizeImagen($data, $_POST['width']);
                //Guardar los datos en la base de datos
                $image = array('name' => $image_name, 'path' => $path
                    , 'extension' => $data['file_ext']);
                $imageid = $this->imagemodel->insert($image);
                //Crea la relacion
                $relation = array('tableItem' => $_POST['tableItem'],
                    'item' => $_POST['item'],
                    'image' => $imageid);
                $this->imagemodel->insertMapImage($relation);
                redirect($_POST['tableItem'] . '/view/' . $_POST['item']);
            }
        } else {
            //Obtiene los datos de insertcion
            $tableItem = $this->uri->segment(3);
            $item = $this->uri->segment(4);
            //Estan vacios los datos?
            if ($item != 0 && $tableItem == 'place' ||
                    $tableItem == 'promotion') {
                //El item es tuyo?
                $result = array();
                switch ($tableItem) {
                    case 'place':
                        $result = $this->placemodel->
                                getPlace(array('place' => $item));
                        break;
                    case 'promotion':
                        $result = $this->promotionmodel->
                                getPromotion(array('promotion' => $item));
                        break;
                }
                if (count($result) > 0 || $this->data['type'] == 'admin') {
                    $this->data['tableItem'] = $tableItem;
                    $this->data['item'] = $item;
                    $this->load->view('common/header', $this->data);
                    $this->load->view('common/adminMenu');
                    $this->load->view('image/add');
                    $this->load->view('common/footer');
                } else {
                    redirect('admin');
                }
            } else {
                redirect('admin');
            }
        }
    }

}