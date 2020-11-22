<?php

class Historial_model extends CI_Model
{
    private $mytable;
    
    public function __construct()
    {
        parent::__construct();
        $this->mytable = 'historial';
    }
    
    public function get($id)
    {                
        $historial = $this->db->get_where('historial', array('id' => $id));
        
        if ($historial->num_rows() == 1)
        {   
            $row = $historial->row();
            $row->id = (int)$row->id;
            $row->hospital_id = (int)$row->hospital_id;
            return $row;
        }
        else
        {
            return null;
        }        
    }
    
    public function save($id, $hospital_id)
    {
        $this->db->set(array('id'=>$id, 'hospital_id'=>$hospital_id));
        
        $this->db->insert('historial');
        
        if ($this->db->affected_rows() == 1)
        {
            return TRUE;
        }
        else{
            return FALSE;
        }
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

