<?php

class Examen_fisico_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'examen_fisico';
    }
    
    public function get($id){
        
        $this->db->where('id', $id);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()==1){
            $row = $query->row();
            $row->id = (int)$row->id;
            $row->peso = (float)$row->peso;
            $row->talla = (float)$row->talla;
            $row->imc = (int)$row->imc;
            $row->perimetro_cintura = (int)$row->perimetro_cintura;
            $row->ta_sistolica = (int)$row->ta_sistolica;
            $row->ta_diastolica = (int)$row->ta_diastolica;
            return $row;
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

