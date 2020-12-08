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

    public function index_get()
    {
        $query = $this->mymodel->get();

        if (!is_null($query)) {
            $this->response(array('users' => $query), 200);
        } else {
            $this->response(array('error' => 'No existen usuarios registrados ...'), 404);
        }
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
        $rol = $this->post('rol');
        
        if ($this->mymodel->create($email, $password, $rol))
        {
            $this->response(array('ok' => 'Usuario creado exitosamente.'), 200);
        }
        else
        {
            $this->response(array('message' => 'Email o Contraseña incorrectos'), 400);
        }
    }
}
