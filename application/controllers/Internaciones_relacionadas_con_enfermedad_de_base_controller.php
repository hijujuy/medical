<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

class Internaciones_relacionadas_con_enfermedad_de_base_controller extends REST_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('internaciones_relacionadas_con_enfermedad_de_base_model', 'mymodel');
    }
    
    public function index_get($id_historial = NULL) {
        
        if (is_null($id_historial))
        {
            $this->response(array('error' => 'El ID fue null'), 400);
        }
        else{
            
            $query = $this->mymodel->get($id_historial);
            
            if (!is_null($query))
            {
                $this->response(array('internaciones_relaciondas_con_enfermedad_de_base' => $query), 200);
            }
            else{
                $this->response(array('error' => 'El ID es inexistente'), 400);
            }
        }
    }//End method index_get
    
    public function index_post($id_historial = NULL) {
        
        if (is_null($id_historial)) {
            
            $this->response(array('error' => 'No se propociono ID o es incorrecto'), 400);
        }
        else{
            
            if ($this->mymodel->save_empty($id_historial)) {
                
                $this->response(array('response' => 'El objeto fue creado exitosamente'), 201);
            }
            else{
                
                $this->response(array('error' => 'Ocurrio un error en el servidor'), 400);
            }
        }
    }//End method index_post
    
    public function create_post() {
        
        if (is_null($this->post('data'))) {            
            $this->response(array('error' => 'No se proporciono objeto post'), 400);
        }
        else{
            
            $data = $this->post('data');
            
            $internaciones = $this->mymodel->save_new($data);
            
            if (!is_null($internaciones)) {                
            
                $this->response($internaciones, 201);
                
            }
            else{
                $this->response(array('error' => 'Ocurrio un error en el servidor'), 400);
            }
        }
    }//Fin metodo create_post
    
    
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
    }//Fin metodo update_post
    
    public function delete_post() {
                
        if (is_null($this->post('data'))) {
            $this->response(array('error' => 'El post para el delete no fue proporcionado'), 400);
        }
        else{
            $data = $this->post('data');
            $internaciones = $this->mymodel->delete($data);
            
            if (!is_null($internaciones)){
                $this->response($internaciones, 200);
            }
            else{
                $this->response(array('error' => 'Ocurrio un error en el servidor'), 400);
            }
        }
        
    }
    
}

