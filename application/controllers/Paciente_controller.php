<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Paciente_controller extends REST_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('paciente_model', 'mymodel');
    }
    
    public function index_get()
    {
        $pacientes = $this->mymodel->get();
        
        if (!is_null($pacientes))
        {
            $this->response(array('pacientes' => $pacientes), 200);
        }else 
        {
            $this->response(array('error' => 'No existen pacientes registrados ...'), 404);
        }
    }
        
    public function find_get($id = null) 
    {
        if (is_null($id))
        {
            $this->response(array("error" => "Debe proporcionar valor ID de paciente como parametro"), 400);
        }
        
        $paciente = $this->mymodel->get($id);
                
        if (!is_null($paciente))
        {
            $this->response(array('paciente' => $paciente) , 200);
        }
        else
        {
            $this->response(array('error' => 'Paciente no encontrado'), 404);
        }
    }

    public function findall_get($id_user = null)
    {
        if (is_null($id_user))
        {
            $this->response(array("error" => "Debe proporcionar valor ID del medico como parametro"), 400);
        }
        
        $pacientes = $this->mymodel->getAll($id_user);
                
        if (!is_null($pacientes))
        {
            $this->response(array('pacientes' => $pacientes) , 200);
        }
        else
        {
            $this->response(array('error' => 'Pacientes no encontrados para el medico'), 404);
        }
    }
    
    public function index_post()
    {
        if (!$this->post('paciente'))
        {
            $this->response(array('error' => 'No hay paciente para registrar'), 400);
        }
        
        $id = $this->my_model->save($this->post('paciente'));
        
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
    
    public function index_delete($id)
    {
        if (!$id)
        {
            $this->response(null, 400);            
        }
        
        $delete = $this->mymodel->delete($id);
        
        if ($delete)
        {
            $this->response(array('response' => 'El paciente fue eliminado satisfactoriamente'), 200);
        }
        else
        {
            $this->response(array('error' => 'Surgio un error en el servidor'), 400);
        }
    }
        
}

