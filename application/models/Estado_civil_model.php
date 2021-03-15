<?php

class Estado_civil_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'estado_civil';
    }
    
    public function get(){
                
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()>=1){
            $estado_civiles = $query->result();
            foreach ($estado_civiles as $estado_civil) {
                $estado_civil->id = (int)$estado_civil->id;
            }
            return $estado_civiles;
            
        }else{
            
            return NULL;
        }
    }
    
    public function save($id) {
        
        $data = array('id' => $id);
        
        $query = $this->db->insert($this->mytable, $data);
        
        if ($query && $this->db->affected_rows()==1){
            
            return TRUE;
        }else{
            
            return FALSE;
        }
    }
    
    public function update($id, $data) {
        
        if ($this->db->field_exists($data['campo'], $this->mytable)) {
            
            $this->db->set($data['campo'], $data['nuevo_valor']);
            
            $this->db->where('id', $id);
            
            $query = $this->db->update($this->mytable);
            
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

