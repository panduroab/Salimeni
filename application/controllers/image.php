<?php

class Image extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Cambia el tamaño de una imagen de acuerdo a la ruta y a las medidas
     */
    public function thumb()
    {
        if ($_GET['src'] != NULL && $_GET['h'] != NULL && $_GET['w'] != NULL
                && $_GET['name'] != NULL) {
            $src = $_GET['src'];
            $height = $_GET['h'];
            $width = $_GET['w'];
            $name = $_GET['name'];
            $config['image_library'] = 'gd2';
            $config['source_image'] = $src . $name;
            $config['new_image'] = $src . 'thumbs/' . $name;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = $width;
            $config['height'] = $height;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            redirect('application/' . $src . 'thumbs/' . $name);
        }
    }

}