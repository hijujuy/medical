<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Tipos_enfermedad_controller extends REST_Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index_get($id = NULL) {
        
        if (is_null($id))
        {
            $this->response(array('error' => 'El ID fue null'), REST_Controller::HTTP_BAD_REQUEST);
        }
        else{
            
            $query = $this->tipos_enfermedad_model->get($id);
            
            if (!is_null($query))
            {
                $this->response(array('tipos_enfermedad' => $query), REST_Controller::HTTP_OK);
            }
            else{
                $this->response(array('error' => 'El ID es inexistente'), REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }//End method index_get
    
    public function index_post() {
        $data = $this->post('data');
        
        if (is_null($data)) {
            
            $this->response(array('error' => 'No se propociono ID o es incorrecto'), REST_Controller::HTTP_BAD_REQUEST);
        }
        else{
            
            if ($this->tipos_enfermedad_model->save($data)) {
                
                $this->response(array('response' => 'El objeto fue creado exitosamente'), REST_Controller::HTTP_CREATED);
            }
            else{
                
                $this->response(array('error' => 'Ocurrio un error en el servidor'), REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }//End method index_post
    
    public function update_post() {
        
        if (is_null($this->post('data'))) {
            
            $this->response(array('error' => 'No se proporciono objeto post o ID'), REST_Controller::HTTP_BAD_REQUEST);
        }
        else{
            
            $data = $this->post('data');
            
            if ($this->tipos_enfermedad_model->update($data)) {
                
                $this->response(array('response' => 'El objeto fue actualizado exitosamente'), REST_Controller::HTTP_OK);
            }
            else{
                $this->response(array('error' => 'Ocurrio un error en el servidor'), REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }//Fin metodo update_post
}

