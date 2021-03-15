<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Hospital_controller extends REST_Controller
{
    public function __construct(){
        parent::__construct();
    }
    
    public function index_get() {
            $query = $this->hospital_model->get();
            
            if (!is_null($query))
            {
                $this->response(array('hospital' => $query), REST_Controller::HTTP_OK);
            }
            else{
                $this->response(array('error' => 'No hay hospitales registrados'), REST_Controller::HTTP_BAD_REQUEST);
            }
    }//End method index_get
    
    public function index_post() {
        
        $data = $this->post('data');
        
        if (is_null($data)) {
            
            $this->response(array('error' => 'No se propociono datos por post'), 400);
        }
        else{
            
            if ($this->hospital_model->save($data)) {
                
                $this->response(array('response' => 'El objeto fue creado exitosamente'), 201);
            }
            else{
                
                $this->response(array('error' => 'Ocurrio un error en el servidor'), 400);
            }
        }
    }//End method index_post
    
    public function update_post() {
        
        if (is_null($this->post('data'))) {
            
            $this->response(array('error' => 'No se proporciono objeto post'), 400);
        }
        else{
            
            $data = $this->post('data');
            
            if ($this->hospital_model->update($data)) {
                
                $this->response(array('response' => 'El objeto fue actualizado exitosamente'), 200);
            }
            else{
                $this->response(array('error' => 'Ocurrio un error en el servidor'), 400);
            }
        }
    }//Fin metodo update_post
    
}

