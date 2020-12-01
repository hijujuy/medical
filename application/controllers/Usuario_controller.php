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
    
    public function index_post()
    {        
        $email = $this->post('email');
        $password = $this->post('password');

        $user = $this->mymodel->login($email, $password);

        if ($user)
        {
            $this->response(array('user' => $user), 200);
        }
        else
        {
            $this->response(array('error' => 'Usuario o contraseña invalidos ...'), 401);
        }
    }

}
