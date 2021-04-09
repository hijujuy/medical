<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Usuarios_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_model', 'mymodel');
    }
    
    public function login_post()
    {   
        if (empty($this->post('email')) || empty($this->post('password')))
        {
            $this->response(array("error" => "Debe proporcionar nombre de usuario y contraseña"), 400);
        }
        
        $email = $this->post('email');
        
        if (!$this->mymodel->verify($email)) {
            $this->response(array("error" => "Usuario no registrado"), 400);
        }

        $password = $this->post('password');
        
        if (!$this->mymodel->validate($email, $password)) {
            $this->response(array("error" => "Password no es valido"), 400);
        }

        $usuario = $this->mymodel->get($email, $password);
        /**
         * Usuario => id , nombre, email, password, rango
         */
                
        if (!is_null($usuario))
        {            
            $this->session->set_userdata($usuario);
            
            $this->response(array('mensaje' => 'Bienvenido '.$usuario['nombre']), 200);
        }
    }

    public function logout_get()
    {
        if ($this->session->has_userdata('id'))
        {
            $this->session->sess_destroy();

            $this->response(array('mensaje' => 'Logout ok'), 200);
        }        
    }
    
}