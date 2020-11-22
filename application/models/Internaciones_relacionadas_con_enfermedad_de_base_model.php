<?php

class Internaciones_relacionadas_con_enfermedad_de_base_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'internaciones_relaciondas_con_enfermedad_de_base';
    }
    
    public function get($id_historial){
        
        $this->db->where('id_historial', $id_historial);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()>=1){
            $internaciones = $query->result();
            foreach ($internaciones as $internacion) {
                $internacion->id = (int)$internacion->id;
                $internacion->dias = (int)$internacion->dias;
                $internacion->id_historial = (int)$internacion->id_historial;
            }
            return $internaciones;
        }else{
            return NULL;
        }
    }
    
    public function save_empty($id_historial) {
        
        $data = array('id_historial' => $id_historial);
        
        $query = $this->db->insert($this->mytable, $data);
        
        if ($query && $this->db->affected_rows()==1){
            
            return TRUE;
        }else{
            
            return FALSE;
        }
    }
    
    public function save_new($data) {
        
        $internacion = array(
            'fecha' => $data['fecha'],
            'dias' => $data['dias'],
            'causas' => $data['causas'],
            'id_historial' => $data['id_historial']
        );
        
        $query = $this->db->insert($this->mytable, $internacion);
        
        if ($query && $this->db->affected_rows()==1){            
            return $this->get($internacion['id_historial']);
        }else{            
            return null;
        }
           
    }
    
    public function update($id, $data) {
            
            $this->db->set('fecha', $data['fecha']);
            
            $this->db->set('dias', $data['dias']);
            
            $this->db->set('causas', $data['causas']);
            
            $this->db->where('id', $id);
            
            $query = $this->db->update($this->mytable);
            
            if ($query && $this->db->affected_rows()==1) {
                return $this->get($data['id_historial']);
            }
            else{
                return null;
            }
        
    }
    
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        
        $this->db->delete($this->mytable);
        
        if ($this->db->affected_rows() == 1)
        {
            return $this->get($data['id_historial']);
        }else{
            return null;
        }       
    }
    
    
}

