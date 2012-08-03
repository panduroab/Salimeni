<?php



class Placemodel extends CI_Model

{



    public function __construct()

    {

        parent::__construct();

    }



    /**

     * Inserta un Place en la base de datos

     * @param array $place

     * @return type 

     */

    public function addPlace(array $place)

    {

        $this->db->insert('place', $place);

        return $this->db->insert_id();

    }



    /**

     * Actualiza un place en la base de datos

     * @param array $place 

     */

    public function updatePlace(array $place)

    {

        $this->db->update('place', $place);

    }



    /**

     * Elimina un place en la base de datos

     * @param array $place 

     */

    public function deletePlace(array $place)

    {

        $this->db->delete('place', $place);

    }



    /**

     * Obtiene un place de la base de datos

     * @param array $place

     * @return type 

     */

    public function getPlace(array $place = NULL, array $category = NULL)

    {

        $result = array();

        if (!is_null($place)) {

            $query = $this->db->get_where('place', $place);

            foreach ($query->result_array() as $row) {

            //if ($query->num_rows() > 0)

                $result[] = $row;}

            return $result;

        } else if (!is_null($category)) {

            $query = $this->db->get_where('place', $category);

            foreach ($query->result_array() as $row) {

                $result[] = $row;

            }

            return $result;

        } else if (is_null($place) && is_null($category)) {

            $query = $this->db->get('place');

            foreach ($query->result_array() as $row) {

                $result[] = $row;

            }

            return $result;

        }

    }



    /**

     * Agrega un mapUserPlace a la base de datos

     * @param array $mapUserPlace

     * @return type 

     */

    public function addMapUserPlace(array $mapUserPlace)

    {

        $this->db->insert('mapUserPlace', $mapUserPlace);

    }



    /**

     * Actualiza un mapUserPlace en la base de datos

     * @param array $mapUserPlace 

     */

    public function updateMapUserPlace(array $mapUserPlace)

    {

        $this->db->update('mapUserPlace', $mapUserPlace);

    }



    /**

     * Elimina un mapUserPlace en la base de datos

     * @param array $mapUserPlace 

     */

    public function deleteMapUserPlace(array $mapUserPlace)

    {

        $this->db->delete('mapUserPlace', $mapUserPlace);

    }



    /**

     * Obtiene los lugares de un usuario

     * @param array $user 

     */

    public function getPlaceUser($user)

    {

        $result = array();

        $this->db->select('place.place, place.name, place.details, place.adresse,

            place.latitude, place.longitude, place.category, user');

        $this->db->from('mapUserPlace');

        $this->db->join('place', 'place.place = mapUserPlace.place', 'left');

        $this->db->where('user', $user);

        $query = $this->db->get();

        foreach ($query->result_array() AS $row) {

            $result[] = $row;

        }

        return $result;

    }

    /**
    * Retorna la lista de los lugares con sus respectivas imagenes
    */
    public function getPlaceImage()
    {
        $result = array();
        $this->db->select('place.*, CONCAT( image.path, image.name, image.extension ) AS image');
        $this->db->from('place');
        $this->db->join('mapImagePlace', 'mapImagePlace.place = place.place', 'left');
        $this->db->join('image', 'image.image = mapImagePlace.image', 'left');
        $this->db->group_by("place.place"); 
        $query = $this->db->get();
        foreach ($query->result_array() AS $row) {
            $result[] = $row;
        }
        return $result;
    }

}