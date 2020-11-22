<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Odontologia_controller extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('odontologia_model', 'mymodel');
    }
    
    public function index_get($id) {
        
        if (is_null($id)) {
            $this->response(array('error' => 'El id fue nul'), 400);
        }
        else
        {
            $register = $this->mymodel->get($id);
            
            if (!is_null($register)) {
                
                $this->response(array('response' => $register), 200);
            }
            else
            {
                $this->response(array('error' => 'ID inexistente.'), 400);
            }
        }        
    }
    
    public function index_post($id) {
        
        if (is_null($id)) {
            $this->response(array('error' => 'El id fue nul'), 400);
        }
        else
        {
            $query = $this->mymodel->save($id);
            
            if ($query == $id) {
                
                $this->response(array('response' => 'El objeto fue creado exitosamente'), 201);
            }
            else
            {
                $this->response(array('error' => $query), 400);
            }
        }
                
    }
    
    public function update_post($id) {
        
        if (!$this->post('data') || !$id)
        {
            $this->response(array('error' => 'No se proporciono el id el post(data)'), 400);
        }
        
        $query = $this->mymodel->update($id, $this->post('data'));
        
        if (!is_null($query))
        {
            if ($query['update'])
            {
                $this->response(array('value' => $query['value']), 200);
            }
            else
            {
                $this->response(array('error' => $query['value']), 400);
            }
        }
        else
        {
            $this->response(array('error' => 'Campo seleccionado es inexistente'), 404);
        }
    }
    
}

