<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Estudio_controller extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('estudio_model', 'mymodel');
    }
    
    public function index_get($id = NULL) {
        
        if (is_null($id))
        {
            $this->response(array('error' => 'El ID fue null'), 400);
        }
        else{
            
            $query = $this->mymodel->get($id);
            
            if (!is_null($query))
            {
                $this->response(array('estudio' => $query), 200);
            }
            else{
                $this->response(array('error' => 'El ID es inexistente'), 400);
            }
        }
    }//End method index_get
    
    public function index_post($id = NULL) {
        
        if (is_null($id)) {
            
            $this->response(array('error' => 'No se propociono ID o es incorrecto'), 400);
        }
        else{
            
            if ($this->mymodel->save($id)) {
                
                $this->response(array('response' => 'El objeto fue creado exitosamente'), 201);
            }
            else{
                
                $this->response(array('error' => 'Ocurrio un error en el servidor'), 400);
            }
        }
    }//End method index_post
    
    public function update_post($id = NULL) {
        
        if (is_null($id) || is_null($this->post('data'))) {
            
            $this->response(array('error' => 'No se proporciono objeto post o ID'));
        }
        else{
            
            $data = $this->post('data');
            
            if ($this->mymodel->update($id, $data)) {
                
                $this->response(array('response' => 'El objeto fue actualizado exitosamente'));
            }
            else{
                $this->response(array('error' => 'Ocurrio un error en el servidor'), 400);
            }
        }
    }//Fin metodo update_post
    
}

