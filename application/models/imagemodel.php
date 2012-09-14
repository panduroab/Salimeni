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
    public function insert(array $image)
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
     * Devuelve imagenes segun el filtro
     * @param array $image
     * @return type
     */
    public function getImage($table, $id)
    {
        $result = array();
        $this->db->select('CONCAT( path, name, extension ) AS image');
        $this->db->from('mapImage');
        $this->db->join('image', 'image.image = mapImage.image', 'left');
        $this->db->where('mapImage.item', $id);
        $this->db->where('mapImage.tableItem', $table);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * Sube una imagen al servidor
     * @param type $path
     * @param type $file
     * @return type
     */
    public function upload($path, $file)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            return $this->upload->data();
        }
    }

    /**
     * Cambia el tamaño de una imagen
     * @param type $data
     * @param type $newwidth
     * @return string
     */
    public function resizeImagen($data, $newwidth)
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
        $newheight = ($height / $width) * $newwidth;
        $tmp = imagecreatetruecolor($newwidth, $newheight);
        $newwidth1 = 32;
        $newheight1 = ($height / $width) * $newwidth1;
        $tmp1 = imagecreatetruecolor($newwidth1, $newheight1);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
        $image_name = time();
        $filename = $image_name . '' . $data['file_ext'];
        $filename1 = $image_name . "_thumb" . '' . $data['file_ext'];
        imagejpeg($tmp, $data['file_path'] . $filename, 100);
        imagejpeg($tmp1, $data['file_path'] . $filename1, 100);
        unlink($data['full_path']);
        imagedestroy($src);
        imagedestroy($tmp);
        imagedestroy($tmp1);
        return $image_name;
    }

}