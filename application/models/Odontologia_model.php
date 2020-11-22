<?php

class Odontologia_model extends CI_Model
{
    private $mytable;
    
    public function __construct() {
        parent::__construct();
        $this->mytable = 'odontologia';
    }
    
    public function get($id) {
        
        $this->db->where('id', $id);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()==1) {
            $row = $query->row();
            $row->id = (int)$row->id;
            $row->control_odontologico = (bool)$row->control_odontologico;
            $row->enfermedad_periodontal = (bool)$row->enfermedad_periodontal;
            $row->flemones = (bool)$row->flemones;
            return $row;
        }
        else {
            
            return NULL;
        }        
    }
    
    public function save($id) {
        
        $this->db->set('id', $id);
        
        $query = $this->db->insert($this->mytable);
        
        if ($query && $this->db->affected_rows()==1) {
            return $id;
        }
        else
            return $this->db->error();
        
    }
    
    public function update($id, $data) {
        
        if ($this->db->field_exists($data['campo'], $this->mytable)) {
            
            $this->db->set($data['campo'], $data['nuevo_valor']);
            
            $this->db->where('id', $id);
            
            $query = $this->db->update($this->mytable);
            
            if ($query)
            {
                $response = "Guardado";
            }
            else
            {
                $response = $this->db->error();
            }
            
            return array('update' => $query, 'value' => $response);
        }
        
        return null; 
    }
    
}

