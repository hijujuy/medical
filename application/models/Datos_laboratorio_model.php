<?php

class Datos_laboratorio_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'datos_laboratorio';
    }
    
    public function get($id){
        
        $this->db->where('id', $id);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()==1){
            $row = $query->row();
            $row->id = (int)$row->id;
            $row->glucemia = (float)$row->glucemia;
            $row->hba1c = (int)$row->hba1c;
            $row->got = (int)$row->got;
            $row->gpt = (int)$row->gpt;
            $row->fal = (int)$row->fal;
            $row->colesterol_total = (int)$row->colesterol_total;
            $row->hdl = (int)$row->hdl;
            $row->ldl = (int)$row->ldl;
            $row->trigliceridos = (int)$row->trigliceridos;
            $row->clearence_de_creatinina = (int)$row->clearence_de_creatinina;            
            $row->creatinina = (float)$row->creatinina;
            $row->estadio = (float)$row->estadio;
            $row->proteinuria = (float)$row->proteinuria;
            $row->creatininuria = (float)$row->creatininuria;
            $row->microalbuminuria = (float)$row->microalbuminuria;
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

