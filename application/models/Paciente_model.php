<?php

class Paciente_model extends CI_Model
{
    private $mytable;    
    
    public function __construct()
    {
        parent::__construct();
        $this->mytable = 'paciente';
    }
    
    public function get($id = null)
    {           
        if (is_null($id))
        {
            $query = $this->db->get('paciente');
            
            if ($query->num_rows() > 0)
            {   
                $pacientes = $query->result();                
                foreach ($pacientes as $paciente) {
                    $paciente->id = (int)$paciente->id;
                    $paciente->dni = (int)$paciente->dni;
                    $paciente->genero_id = (int)$paciente->genero_id;
                    $paciente->estado_civil_id = (int)$paciente->estado_civil_id;
                    $paciente->obra_social_id = (int)$paciente->obra_social_id;
                    $paciente->estudio_id = (int)$paciente->estudio_id;
                    $paciente->localidad_id = (int)$paciente->localidad_id;
                    $paciente->departamento_id = (int)$paciente->departamento_id;
                }
                
                return $pacientes;
            }
            return null;
        }
        else
        {            
            $query = $this->db->get_where('paciente', array('id'=>$id));
            
            if ($query->num_rows() == 1)
            {
                $paciente = $query->row();
                $paciente->id = (int)$paciente->id;
                $paciente->dni = (int)$paciente->dni;
                $paciente->genero_id = (int)$paciente->genero_id;
                $paciente->estado_civil_id = (int)$paciente->estado_civil_id;
                $paciente->obra_social_id = (int)$paciente->obra_social_id;
                $paciente->estudio_id = (int)$paciente->estudio_id;
                $paciente->localidad_id = (int)$paciente->localidad_id;
                $paciente->departamento_id = (int)$paciente->departamento_id;
                return $paciente;
            }
            
            return null;
        }
        
    }
        
    public function save($paciente)
    {
        $this->db->set($this->_setPaciente($paciente));
        
        $this->db->insert('paciente');
        
        if ($this->db->affected_rows() == 1)
        {
            return $this->db->insert_id();
        }else{
            return NULL;
        }
                
    }
    
    public function update($id, $data)
    {   
        
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
    
    public function delete($id)
    {
        $this->db->where('id', $id);
        
        $this->db->delete('paciente');
        
        if ($this->db->affected_rows() == 1)
        {
            return TRUE;
        }
        
        return FALSE;
    }
    
    private function _setPaciente($paciente)
    {
        return array(
            'dni' => $paciente['dni'],
            'nombre' => $paciente['nombre'],
            'fecha_nacimiento' => $paciente['fecha_nacimiento'],
            'domicilio' => $paciente['domicilio'],
            'telefono' => $paciente['telefono'],
            'genero_id' => $paciente['genero_id'],
            'estado_civil_id' => $paciente['estado_civil_id'],
            'obra_social_id' => $paciente['obra_social_id'],
            'estudio_id' => $paciente['estudio_id'],
            'localidad_id' => $paciente['localidad_id'],
            'departamento_id' => $paciente['departamento_id']
        );
    }
    
}