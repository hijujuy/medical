<?php

class Enfermedades_asociadas_model extends CI_Model
{
    private $mytable;
    
    public function __construct()
    {
        parent::__construct();
        $this->mytable = "enfermedades_asociadas";
    }
    
    public function get($id) 
    {
        $this->db->where('id', $id);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()==1)
        {
            $row = $query->row();
            $row->id = (int)$row->id;
            $row->enfermedad_tiroidea = (bool)$row->enfermedad_tiroidea;
            $row->enfermedad_tiroidea_tipo = (int)$row->enfermedad_tiroidea_tipo;
            $row->tbc = (bool)$row->tbc;
            $row->enfermedad_celiaca = (bool)$row->enfermedad_celiaca;
            $row->enfermedad_reumatica = (bool)$row->enfermedad_reumatica;
            $row->enfermedad_reumatica_tipo = (int)$row->enfermedad_reumatica_tipo;
            return $row;
        }
        else
        {
            return null;
        }
    }
    
    public function save($id)
    {
        $this->db->set('id', $id);
        
        $query = $this->db->insert($this->mytable);
        
        if ($query && $this->db->affected_rows() == 1) 
        {
            return TRUE;
        }
        else {
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










