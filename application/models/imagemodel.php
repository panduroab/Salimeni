<?php

class Imagemodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 
     * @param array $image
     * @return type
     */
    public function insertImage(array $image)
    {
        $this->db->insert('image', $image);
        return $this->db->insert_id();
    }

    /**
     * 
     * @param type $id
     * @param array $image
     */
    public function updateImage($id, array $image)
    {
        $this->db->where('image', $id);
        $this->db->update($image);
    }

    /**
     * 
     * @param array $image
     */
    public function deleteImage(array $image)
    {
        $this->db->delete('image', $image);
    }

    /**
     * 
     * @param array $mapImage
     */
    public function insertMapImage(array $mapImage)
    {
        $this->db->insert('mapImage', $mapImage);
    }

    /**
     * 
     * @param array $mapImage
     */
    public function deleteMapImage(array $mapImage)
    {
        $this->db->delete('mapImage', $mapImage);
    }

    /**
     * Funcion que sube los archivos del expediente
     * @param type $id Array con el nombre del campo y el dato
     * @param type $table Tabla a la que pertenece el archivo
     * @param type $carpeta Carpeta en la que se guardara
     * @param type $camp Nombre del campo de donde viene el archivo
     */
    private function uploadFile(array $item, $tableItem, $fullPath)
    {
        $config['upload_path'] = $fullPath;
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($camp)) {
            $error = array('error' => $this->upload->display_errors());
            //Enviar mensaje de error
        } else {
            //Se cambia el tamaño y el nombre de la imagen
            //Se insertan todos los datos de la imagen en la tabla image
            //La imagen es nueva o es una edicion?
                //Se crea la relacion entre la imagen y el item y tableItem
            //Se actualiza la relacion si era una edicion de imagen
            $image = $this->insertImage($error);
            $this->db->update($table, array($column => $columna), $id); //Sube imagen y guarda el nombre el bd
        }
    }

    /**
     * Cambia el tamño de la imagen y crea las miniaturas
     * @param type $data
     * @return string 
     */
    private function resizeImagen($data, $ancho, $camp)
    {
        if ($data['image_type'] == "jpg" || $data['image_type'] == "jpeg") {
            $uploadedfile = $data['full_path'];
            $src = imagecreatefromjpeg($uploadedfile);
        } else if ($data['image_type'] == "png") {
            $uploadedfile = $data['full_path'];
            $src = imagecreatefrompng($uploadedfile);
        } else {
            $src = imagecreatefromgif($uploadedfile);
        }
        list($width, $height) = getimagesize($uploadedfile);
        $width = $data['image_width'];
        $height = $data['image_height'];
        $newwidth = $ancho;
        $newheight = ($height / $width) * $newwidth;
        $tmp = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        $image_name = time() . '' . $data['file_ext'];
        $filename = $camp . "_" . $image_name;
        imagejpeg($tmp, $data['file_path'] . $filename, 100);
        unlink($data['full_path']);
        imagedestroy($src);
        imagedestroy($tmp);
        return $filename;
    }

    /**
     * 
     */
    public function generateThumbnail()
    {
        
    }

    /**
     * Obtiene las imagenes de mapImagePlace o mapImagePromotion dependiendo del
     * array
     * @param type $var array('table'=>'', 'id'=>'', 'column'=>'')
     */
    public function getImage(array $var)
    {
        $result = array();
        $this->db->select('CONCAT( i.path,i.name,i.extension ) AS image');
        $this->db->from($var['column'] . ' p');
        $this->db->join($var['table'] . ' mip', 'mip.' . $var['column'] . ' = p.' . $var['column'], 'left');
        $this->db->join('image i', 'i.image = mip.image', 'left');
        $this->db->where('p.' . $var['column'], $var['id']);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $result[] = $row;
        }
        return $result;
    }

}