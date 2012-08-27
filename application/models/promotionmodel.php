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
    public function updatePromotion(array $promotion, $id)
    {
        $this->db->where('promotion', $id);
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
     * Inserta la relacion entre un lugar y una promocion
     * @param type $mapPlacePromotion
     */
    public function addMapPlacePromotion($mapPlacePromotion)
    {
        $this->db->insert('mapPlacePromotion', $mapPlacePromotion);
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
            foreach ($query->result_array() as $row) {
                $result[] = $row;
            }
            return $result;
        }
    }

    /**
     * Devuelve la promocion si le pertence a un lugar administrado por el 
     * usuario
     * @param type $promotion
     * @param type $user
     * @return type
     */
    public function getPromotionUser($promotion, $user)
    {
        $result = array();
        $this->db->select('promotion.promotion, promotion.name, promotion.details,
            promotion.startAt, promotion.endsAt, promotion.category, 
            promotion.type, promotion.class, promotion.day,
            promotion.url, place.place');
        $this->db->from('mapPlacePromotion');
        $this->db->join('promotion', 'promotion.promotion = mapPlacePromotion.promotion', 'left');
        $this->db->join('place', 'place.place = mapPlacePromotion.place', 'left');
        $this->db->join('mapUserPlace', 'mapUserPlace.place = place.place', 'left');
        $this->db->join('user', 'user.user = mapUserPlace.user', 'left');
        $this->db->where('mapPlacePromotion.promotion', $promotion);
        $this->db->where('user.user', $user);
        $this->db->group_by('promotion');
        $query = $this->db->get();
        foreach ($query->result_array() AS $row) {
            $result[] = $row;
        }
        return $result;
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
            promotion.type, promotion.class, promotion.url');
        $this->db->from('mapPlacePromotion');
        $this->db->join('promotion', 'promotion.promotion = mapPlacePromotion.promotion', 'left');
        $this->db->where('mapPlacePromotion.place', $place);
        $query = $this->db->get();
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
    public function getMainPromo($promotion = NULL, $time = NULL, $category = NULL)
    {
        $result = array();
        $this->db->select('p.promotion, p.name, p.details, p.createdAt, 
            p.startAt, p.endsAt, p.class, c.category AS categoryId, 
            c.name AS category, s.subcategory AS subcategoryId, 
            s.name AS subcategory, pl.place AS placeId, pl.name AS place, 
            pl.details AS placeDetails, pl.latitude, pl.longitude, pl.url');
        $this->db->from('promotion p');
        $this->db->join('category c', 'c.category = p.category', 'left');
        $this->db->join('subcategory s', 's.category = c.category', 'left');
        $this->db->join('mapPlacePromotion mpp', 'mpp.promotion = p.promotion', 'left');
        $this->db->join('place pl', 'pl.place = mpp.place', 'left');
        if (!is_null($promotion))
            $this->db->where('p.promotion', $promotion);
        if (!is_null($time)) {
            $end = date('Y-m-d H:i:s', time() + 14400);
            $this->db->where("p.startAt BETWEEN ", "'$time' AND '$end'", FALSE);
        }
        if (!is_null($category))
            $this->db->where('p.category', $category);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * Busca una promocion por medio de una palabra clave
     * @param type $word
     * @return array
     */
    public function search($word)
    {
        $result = array();
        return $result;
    }

}