<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Enfermedad_controller extends REST_Controller
{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index_get() {
        
        $enfermedad = $this->enfermedad_model->getAll();
        
        if (!is_null($enfermedad))
        {
            $this->response(array('enfermedad' => $enfermedad), 200);
        }else
        {
            $this->response(array('error' => 'No existen enfermedades registradas ...'), 404);
        }
        
    }
    
    public function find_get($id = NULL) {
        
        if (is_null($id))
        {
            $this->response(array('error' => 'El ID fue null'), 400);
        }
        else{
            
            $query = $this->enfermedad_model->get($id);
            
            if (!is_null($query))
            {
                $this->response(array('enfermedad' => $query), 200);
            }
            else{
                $this->response(array('error' => 'El ID es inexistente'), 400);
            }
        }
    }//End method index_get
    
    public function index_post() {
        
        if (is_null($this->post('data'))) {
            
            $this->response(array('error' => 'No se propociono el objeto data'), 400);
        }
        else{
            
            $data = $this->post('data');
            
            if ($this->enfermedad_model->save($data)) {
                
                $this->response(array('response' => 'El objeto fue creado exitosamente'), 201);
            }
            else{
                
                $this->response(array('error' => 'Ocurrio un error en el servidor'), 400);
            }
        }
    }//End method index_post
    
    public function update_post() {
        
        if (is_null($this->post('data'))) {
            
            $this->response(array('error' => 'No se proporciono objeto post o ID'), 400);
        }
        else{
            
            $data = $this->post('data');
            
            if ($this->enfermedad_model->update($data)) {
                
                $this->response(array('response' => 'El objeto fue actualizado exitosamente'), 200);
            }
            else{
                $this->response(array('error' => 'Ocurrio un error en el servidor'), 400);
            }
        }
    }//Fin metodo update_post
    
}
