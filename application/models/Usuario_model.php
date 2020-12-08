<?php

class Usuario_model extends CI_Model
{
    private $mytable;

    public function __construct()
    {
        parent::__construct();
        $this->mytable = 'usuario';
        $this->load->library('encryption');
    }

    public function get()
    {
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query)){            
            return $query->result();
        }else{
            return NULL;
        }
    }

    public function login($email, $password)
    {
        $response = NULL;
        //Busco registro de usuario 
        $this->db->select('password');
        $query = $this->db->get_where('usuario', array('email' => $email));
        if ($query->row()) {
            //Usuario registrado
            if ($password == $this->encryption->decrypt($query->row()->password)){
                //Usuario autenticado
                $this->db->select('id, email, rol');
                $query = $this->db->get_where('usuario', array('email' => $email));
                $response = $query->row();
            }
        }
        return $response;        
    }

    public function create($email, $password, $rol)
    {
        $password = $this->encryption->encrypt($password);
        $datos = array('email' => $email, 'password' => $password, 'rol' => $rol);
        if ($this->db->insert($this->mytable, $datos)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}