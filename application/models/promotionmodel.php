<?php

class Promotionmodel extends CI_Model
{

    /**
     * Inicializa el padre
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Agrega una promocion a la base de datos
     * @param array $promotion
     * @return type 
     */
    public function addPromotion(array $promotion)
    {
        $this->db->insert('promotion', $promotion);
        return $this->db->insert_id();
    }

    /**
     * Actualiza una promocion en la base de datos
     * @param array $promotion 
     */
    public function updatePromotion(array $promotion)
    {
        $this->db->update('promotion', $promotion);
    }

    /**
     * Elimina una promocion en la base de datos
     * @param array $promotion 
     */
    public function deletePromotion(array $promotion)
    {
        $this->db->delete('promotion', $promotion);
    }

    /**
     * Devuelve la consulta de una o todas las promociones
     * @param array $promotion 
     */
    public function getPromotion(array $promotion = NULL)
    {
        if (is_null($promotion)) {
            $query = $this->db->get('promotion');
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
            return $result;
        } else {
            $query = $this->db->get_where('promotion', $promotion);
            if ($query->num_rows() > 0)
                $result = $query->row();
            return $result;
        }
    }

    /**
     * Devuelve los eventos que pertenecen a un lugar
     * @param type $place
     * @return type 
     */
    public function getPromotionPlace($place)
    {
        $result = array();
        $this->db->select('promotion.promotion, promotion.name, promotion.details,
            promotion.startAt, promotion.endsAt, promotion.category, 
            promotion.type, promotion.periodicity, promotion.class');
        $this->db->from('mapPlacePromotion');
        $this->db->join('promotion', 
                'promotion.promotion = mapPlacePromotion.promotion', 'left');
        $this->db->where('mapPlacePromotion.place', $place);
        $query = $this->db->get();
        foreach ($query->result_array() AS $row) {
            $result[] = $row;
        }
        return $result;
    }

}