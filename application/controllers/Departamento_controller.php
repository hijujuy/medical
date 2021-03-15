<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Departamento_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();        
    }
    
    public function index_get()
    {
        $departamento = $this->departamento_model->get();
                
        if (!is_null($departamento))
        {
            $this->response(array('departamento' => $departamento), 200);
        }else
        {
            $this->response(array('error' => 'No existen departamentos registrados ...'), 404);
        }
    }
    
    public function find_get($id = null)
    {
        if (is_null($id))
        {
            $this->response(array("error" => "Debe proporcionar valor ID del departamento"), 400);
        }
        
        $departamento = $this->departamento_model->get($id);
        
        if (!is_null($departamento))
        {
            $this->response(array('departamento' => $departamento) , 200);
        }
        else
        {
            $this->response(array('error' => 'Departamento no encontrado'), 404);
        }
    }
    
    public function index_post()
    {
        if (!$this->post('departamento'))
        {
            $this->response(array('error' => 'No hay departamento para registrar'), 400);
        }
        
        $id = $this->departamento_model->save($this->post('departamento'));
        
        if (!is_null($id))
        {
            $this->response(array('id' => $id), 200);
        }else
        {
            $this->response(array('error' => 'Surgio un error en el servidor'), 400);
        }
        
    }
    
    public function update_post($id)
    {
        if (!$this->post('data') || !$id)
        {
            $this->response(null, 400);
        }
        
        $update = $this->departamento_model->update($id, $this->post('data'));
        
        if ($update)
        {
            $this->response(array('response' => 'El departamento fue actualizado satisfactoriamente'), 200);
        }
        else
        {
            $this->response(array('error' => 'Surgio un error en el servidor'), 400);
        }
    }
    
    public function index_delete($id = null)
    {
        if (is_null($id))
        {
            $this->response(array("error" => "El ID fue null"), 400);
        }
        
        $delete = $this->departamento_model->delete($id);
        
        if ($delete)
        {
            $this->response(array('response' => 'El departamento fue eliminado satisfactoriamente'), 200);
        }
        else
        {
            $this->response(array('error' => 'Surgio un error en el servidor'), 400);
        }
    }
    
    
}

