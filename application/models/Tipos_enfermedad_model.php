<?php

class Tipos_enfermedad_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
    }
    
    public function get($id){
        
        $this->db->where('enfermedad_id', $id);
        
        $query = $this->db->get('tipos_enfermedad');
        
        if (!is_null($query) && $query->num_rows()>0){
            
            return $query->result();
            
        }else{
            return NULL;
        }
    }
    
    public function save($data) {
        
        $array = array(
            'descripcion' => $data['descripcion'],
            'enfermedad_id' => $data['enfermedad_id']
        );
        
        $query = $this->db->insert('tipos_enfermedad', $array);
        
        if ($query && $this->db->affected_rows()==1){
            
            return TRUE;
        }else{
            
            return FALSE;
        }
        
    }
    
    public function update($data) {
        
        if ($this->db->field_exists($data['campo'], 'tipos_enfermedad')) {
            
            $this->db->set($data['campo'], $data['nuevo_valor']);
            
            $this->db->where('id', $data['id']);
            
            $query = $this->db->update('tipos_enfermedad');
            
            if ($query && $this->db->affected_rows()==1) {
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        else{
            
            return FALSE;
        }
    }
}

