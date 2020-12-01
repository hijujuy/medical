<?php

class Usuario_model extends CI_Model
{
    private $mytable;

    public function __construct()
    {
        parent::__construct();
        $this->mytable = 'usuario';
    }

    public function login($email, $password)
    {
        $ok = FALSE;
        $this->db->from('usuario');
        $this->db->select('email, rol');
        $datos = array('email' => $email, 'password' => $password);
        $this->db->where($datos);
        $register = $this->db->get();
        if ($register->row())
        {
            $ok = $register->row();
        }
        return $ok;
    }

}