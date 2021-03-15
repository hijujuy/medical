<?php

class Hospital_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'hospital';
    }
    
    public function get(){
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return null;
        }
    }
    
    public function save($data) {
        
        $query = $this->db->insert($this->mytable, $data);
        
        if ($query && $this->db->affected_rows()==1)
        {            
            return true;
        }
        else
        {            
            return false;
        }
    }
    
    public function update($data) {
        
        if ($this->db->field_exists($data['campo'], $this->mytable)) {
            
            $this->db->set($data['campo'], $data['nuevo_valor']);
            
            $this->db->where('id', $data['id']);    
            
            $query = $this->db->update($this->mytable);
            
            if ($query) 
            {
                return true;
            }
            else
            {
                return false;
            }
        }   
        return null;        
    }
    
}

