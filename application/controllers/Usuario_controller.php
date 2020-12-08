<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Usuario_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model', 'mymodel');
    }
    
    public function login_post()
    {        
        $email = $this->post('email');
        $password = $this->post('password');
        $user = $this->mymodel->login($email, $password);
        if ($user) {
            $this->response(array('user' => $user), 200);
        } else{
            $this->response(array('message' => 'Usuario o Contraseña invalidos.'), 401);
        }
    }

    public function create_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');
        
        if ($this->mymodel->create($email, $password))
        {
            $this->response(array('ok' => TRUE), 200);
        }
        else
        {
            $this->response(array('message' => 'Email o Contraseña incorrectos'), 400);
        }
    }

    public function change_password_post()
    {

    }

}
