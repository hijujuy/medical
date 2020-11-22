<?php

class Localidad_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();                
    }
    
    public function get()
    {        
        $localidades = $this->db->get('localidad');

        if ($localidades->num_rows() > 0) {
            $localidades = $localidades->result();
            foreach ($localidades as $localidad) {
                $localidad->id = (int)$localidad->id;
                $localidad->departamento_id = (int)$localidad->departamento_id;
            }
            return $localidades;
            
        } else {
            
            return null;
            
        }        
    }
    
    public function getArray($departamento_id)
    {
        $localidades = $this->db->get_where('localidad', array('departamento_id' => $departamento_id));
        
        if ($localidades->num_rows() > 0) {
            
            return $localidades->result();
            
        } else {
            
            return null;
            
        }
    }
    
    public function save($localidad)
    {
        $data = $this->_setLocalidad($localidad);
        
        $this->db->insert('localidad', $data);
        
        if ($this->db->affected_rows() == 1)
        {
            return $this->db->insert_id();
        }
        else 
        {
            return null;
        }
    }
    
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        
        $this->db->update('localidad', $data);
        
        if ($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        
        $this->db->delete('localidad');
        
        if ($this->db->affected_rows() == 1) return TRUE;
        else return FALSE;
    }
    
    public function _setLocalidad($localidad)
    {
        return array("DESCRIPCION" => $localidad['descripcion'],
                     "CODIGO_POSTAL" => $localidad['codigo_postal'],
                     "DEPARTAMENTO_ID" => $localidad['departamento_id']);
    }
    
}

