<?php

class Categorymodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Obtiene todas las categorias
     * @return type Array de categorias
     */
    public function getCategory()
    {
        $result = array();
        $query = $this->db->get('category');
        foreach ($query->result_array() as $row) {
            $result[] = $row;
        }
        return $result;
    }

}