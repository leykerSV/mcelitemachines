<?php
  /**
  * Modulo de Usarios.
  *
  * @category   Models
  * @package     Modelos
  * @copyright   Copyright (c) Leyker Soft - 2021
  * @license     https://www.leyker.com.ar/eb/licencia.txt
  * @version     1.0.0
  * @author      Leyker <dleyendeker@gmail.com>
  *
  *
  */
Class Userdb extends CI_Model
{

    function login($username, $password)
    {
        date_default_timezone_set('America/Argentina/Cordoba');
        $this->db->select('id, nombre, email, username, password, nivel, habilitado');
        $this->db->from('users');
        $this->db->where('email = ' . "'" . $username . "'");
        $this->db->where('password = ' . "'" . MD5($password) . "'");
        $this->db->where('habilitado = ' . "'" . 1 . "'");
        $this->db->limit(1);

        $query = $this->db->get();
        $a=$query->result();

        if($query->num_rows() == 1)
        {


            return $query->result();
        }
        else
        {
                return false;
        }
    }

	public function getUsersxLeaders()
    {
        $this->db->select('id, nombre');
        $this->db->from('users');
        $this->db->where('habilitado', 1);
        $this->db->order_by("nombre", "asc");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}   
