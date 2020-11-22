<?php

class Departamento_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();        
    }
    
    public function get()
    {           
        $query = $this->db->get('departamento');

        if ($query->num_rows() > 0) {
            $departamentos = $query->result();
            foreach ($departamentos as $departamento) {
                $departamento->id = (int)$departamento->id;
            }
            return $departamentos;            
        } else {
            
            return null;
        }
            
    }
    
    public function save($departamento)
    {
        $array = array('id'=>$departamento['id'],
                       'descripcion'=>$departamento['descripcion']);
        
        $this->db->set($array);
        
        $this->db->insert('departamento');
        
        if ($this->db->affected_rows() == 1)
        {
            return $this->db->insert_id();
        }
        
        return FALSE;
    }
    
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        
        $this->db->update('departamento', $data['key_value']);
        
        if ($this->db->affected_rows() == 1)
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function delete($id)
    {       
        $this->db->where('id', $id);
        
        $this->db->delete('departamento');
        
        if ($this->db->affected_rows() == 1)
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
}

