<?php

class Oftalmologia_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'oftalmologia';
    }
    
    public function get($id){
        
        $this->db->where('id', $id);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()==1){
            $row = $query->row();
            $row->id = (int)$row->id;
            $row->examen_actual = (bool)$row->examen_actual;
            $row->fondo_de_ojos = (bool)$row->fondo_de_ojos;
            $row->amaurosis = (bool)$row->amaurosis;
            $row->cataratas = (bool)$row->cataratas;
            $row->glaucoma = (bool)$row->glaucoma;
            $row->maculopatia = (bool)$row->maculopatia;
            $row->retinopatia = (bool)$row->retinopatia;
            $row->proliferativa = (bool)$row->proliferativa;
            $row->no_proliferativa = (bool)$row->no_proliferativa;
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

