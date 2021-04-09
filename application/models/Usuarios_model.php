<?php

class Usuarios_model extends CI_Model
{
    private $mytable;    
    
    public function __construct()
    {
        parent::__construct();
        $this->mytable = 'usuarios';
    }

    public function verify($email) {
        $data = array('email' => $email);
        $query = $this->db->get_where($this->mytable, $data); 
        if ($query->num_rows() == 1) {
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function validate($email, $password) {
        $data = array('email' => $email, 'password' => $password);
        $query = $this->db->get_where($this->mytable, $data); 
        if ($query->num_rows() == 1) {
            return TRUE;
        }else {
            return FALSE;
        }
    }

    public function get($email, $password) {      
        $data = array('email' => $email, 'password' => $password);
        $query = $this->db->get_where($this->mytable, $data);
        $row = $query->row_array();
        $usuario = array(
            'id'        => $row['id'],
            'nombre'    => $row['nombre'],
            'email'     => $row['email'],
            'rango'     => $row['rango'],
        );
        return $usuario;
    }

}
    