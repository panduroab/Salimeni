<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Filter extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Funcion que realiza una consulta en la base de datos
     * @param type $select
     * @param type $form
     * @param array $join
     * @param array $where
     * @param array $order
     * @return type
     */
    public function select($select, $form, array $join = NULL, array $where = NULL, array $order = NULL)
    {
        $this->db->select($select);
        $this->db->from($form);
        if (!is_null($join)) {
            foreach ($join as $key => $value) {
                $this->db->join($key, $value, 'left');
            }
        }
        if (!is_null($where)) {
            foreach ($where as $row) {
                $this->db->where($row['column'], $row['value']);
            }
        }
        $result = $this->db->get();
        return $result;
    }

}
