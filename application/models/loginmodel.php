<?php

class Loginmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Funcion de login, recibe los parametros y emite un resultado
     * @param array $login
     * @return type 
     */
    public function login(array $login)
    {
        //Consulta en la base de datos
        $result = $this->db->get_where('user', array('email' => $login['email'],
            'password' => $login['password'], 'status' => 'active'));
        if ($result->num_rows() > 0) {
            //Se crea la session
            $return = array('result' => TRUE);
            $row = $result->row();
            $return += (array) $row;
            return $return;
        } else {
            //Se envia el error
            return array('status' => FALSE);
        }
    }

}