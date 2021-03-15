<?php

class Conducta_medica_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'conducta_medica';
    }
    
    public function get($id_historial){
        
        $this->db->where('id_historial', $id_historial);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()>=1){
            $conductas = $query->result();            
            foreach ($conductas as $conducta) {
                $conducta->id = (int)$conducta->id;
                $conducta->id_historial = (int)$conducta->id_historial;                
            }            
            return $conductas;
        }else{
            return NULL;
        }
    }
    
    public function save($data) {
        $conducta = array(
                    'id_historial' => $data['id_historial'],
                    'fecha' => $data['fecha'],
                    'observacion' => $data['observacion']);
        
        $query = $this->db->insert($this->mytable, $conducta);
        
        if ($query && $this->db->affected_rows()==1){            
            return $this->get($data['id_historial']);
        }else{
            
            return null;
        }
    }
    
    public function update($id, $data) {
            
        $this->db->set('fecha', $data['fecha']);
        
        $this->db->set('observacion', $data['observacion']);
            
        $this->db->where('id', $id);
            
        $query = $this->db->update($this->mytable);
            
        if ($query) 
        {            
            return $this->get($data['id_historial']);
        }
        else
        {
           return null;
        }
        
    }
}

