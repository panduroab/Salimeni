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
                    , 'extension' => $data['file_ext'], 'filePath' => $data['file_path']);
                $imageid = $this->imagemodel->insert($image);
                //Crea la relacion
                $relation = array('tableItem' => $_POST['tableItem'],
                    'item' => $_POST['item'],
                    'image' => $imageid);
                $this->imagemodel->insertMapImage($relation);
                redirect('image/add/' . $_POST['tableItem'] . '/' . $_POST['item']);
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
                        $this->data['images'] =
                                $this->imagemodel->getImage('place', $item, TRUE);
                        break;
                    case 'promotion':
                        $result = $this->promotionmodel->
                                getPromotion(array('promotion' => $item));
                        $this->data['images'] =
                                $this->imagemodel->getImage('promotion', $item, TRUE);
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

    /**
     * Elimina una image de la base de datos
     * y renombra la imagen en el servidor
     */
    public function delete()
    {
        if (isset($_POST['image'])) {
            $image = $_POST['image'];
            $this->db->delete('mapImage', array('image' => $image));
            $this->db->delete('image', array('image' => $image));
            $del = $this->imagemodel->get($image);
            $path = $del[0]['filePath'];
            $name = $del[0]['name'];
            $extension = $del[0]['extension'];
            $this->imagemodel->deleteFile($path, $name, $extension);
        }
    }

}