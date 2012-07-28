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
        $select = 'promotion.promotion, promotion.name, promotion.details,
            promotion.startAt, promotion.endsAt, promotion.category, 
            promotion.type, promotion.periodicity, promotion.class';
        $join = array('promotion' => 'promotion.promotion = mapPlacePromotion.promotion');
        $where[] = array('column' => 'mapPlacePromotion.place', 'value' => $place);
        $query = $this->filter->select($select, 'mapPlacePromotion', $join, $where);
        foreach ($query->result_array() AS $row) {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * Retorna las promociones y eventos de acuerdo a los parametros
     * @param type $promotion Id de la promocion que se desea obtener
     * @param type $time Fecha en la que inicia la promocion
     * @param type $category Categoria de la promocion
     * @return type 
     */
    public function getMainPromotion($promotion = NULL, $time = NULL, $category = NULL)
    {
        /**
         * Falta agregar el lugar al que pertenece la promocion 
         */
        $result = array();
        $select = 'p.promotion, p.name, p.details, p.createdAt, 
            p.startAt, p.endsAt, p.class, c.category AS categoryId, 
            c.name AS category, s.subcategory AS subcategoryId, 
            s.name AS subcategory, pl.name AS place, pl.details AS placeDetails,
            pl.latitude, pl.longitude';
        $join = array('category c' => 'c.category = p.category',
            'subcategory s' => 's.category = c.category',
            'mapPlacePromotion mpp' => 'mpp.promotion = p.promotion',
            'place pl' => 'pl.place = mpp.place');
        if (!is_null($promotion))
            $where[] = array('column' => 'p.promotion', 'value' => $promotion);
        if (!is_null($time))
            $where[] = array('column' => 'p.startAt >', 'value' => $time);
        if (!is_null($category))
            $where[] = array('column' => 'p.category', 'value' => $category);
        $query = $this->filter->select($select, 'promotion p', $join, $where);
        foreach ($query->result_array() as $row) {
            $result[] = $row;
        }
        return $result;
    }

}