<?php

class Usermodel extends CI_Model
{

    /**
     * Inicializa al padre 
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Inserta un user en la base de datos
     * @param array $user
     * @return type Id del user insertado
     */
    public function addUser(array $user)
    {
        $this->db->insert('user', $user);
        return $this->db->insert_id();
    }

    /**
     * Actualiza un user en la base de datos
     * @param array $user 
     */
    public function updateUser($id, array $data)
    {
        $this->db->where('user', $id);
        $this->db->update('user', $data);
    }

    /**
     * Elimina un user de la base de datos
     * @param array $user 
     */
    public function deleteUser(array $user)
    {
        $this->db->delete('user', $user);
    }

    /**
     * Obtiene uno, varios o todos los user
     * @param array $user
     * @return type Array
     */
    public function getUser(array $user = NULL)
    {
        $result = array();
        if (is_null($user)) {
            $query = $this->db->get('user');
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
            return $result;
        } else {
            $query = $this->db->get_where('user', $user);
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
            return $result;
        }
    }

    /**
     * Envia un email al usuario registrado
     * @param String $to
     * @param String $paterno
     * @param String $clave
     */
    public function sendEmail($to, $paterno, $clave)
    {
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "smtp.emailsrvr.com";
        $config['smtp_user'] = "no-reply@elchaneke.com";
        $config['smtp_pass'] = "hellbert";
        $config['smtp_port'] = "25";
        $this->email->initialize($config);
        $this->email->from('no-reply@elchaneke.com', 'Soporte DrExp');
        $this->email->to($to);
        $url = base_url('validar/');
        $content = "Dr " . $paterno . ", " . "\r\n" . "\r\n" .
                "Le damos la bienvenida a DrExp, para validar su cuenta y comenzar 
                 a utilizar la aplicación solo siga este enlace 
                 " . $url . "?m=" . $to . "&c=" . $clave . " si no puede dar clic en el copielo y peguelo en la barra de navegación."
                . "\r\n" . "\r\n" .
                "Atte: " .
                "El equipo de soporte de DrExp";
        $this->email->subject('Bienvenido a DrExp');
        $this->email->message($content);
        $this->email->send();
    }

}