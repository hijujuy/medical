<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Diagnosticos_controller extends REST_Controller 
{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('diagnosticos_model', 'mymodel');
    }
    
    public function index_get($id = NULL) {
        
        if (is_null($id))
        {
            $this->response(array('error' => 'No se proporciona ID'), 400);
        }
        else
        {
            $query = $this->mymodel->get($id);
            
            if (!is_null($query))
            {
                $this->response(array('diagnosticos' => $query), 200);
            }else{
                $this->response(array('error' => 'El id es inexistente'), 400); 
            }
        }
    }//End function index_get
    
    public function index_post($id = NULL) {
        
        if (is_null($id)) {
            $this->response(array('error' => 'No se proporiona ID'), 400);
        }
        else{
            if ($this->mymodel->save($id)){
                $this->response(array('response' => 'Objeto creado exitosamente'), 201);
            }
            else{
                $this->response(array('error' => 'No se puede almacemar el objeto'), 400);
            }
        }
        
    }//End method index_post
    
    public function update_post($id = NULL) {
        
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
        
    }//End method update_post
}

