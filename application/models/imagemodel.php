<?php

class Imagemodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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
        $this->db->from($var['column'].' p');
        $this->db->join($var['table'].' mip', 'mip.'.$var['column'].' = p.'.$var['column'], 'left');
        $this->db->join('image i', 'i.image = mip.image', 'left');
        $this->db->where('p.'.$var['column'], $var['id']);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $result[] = $row;
        }
        return $result;
    }

}