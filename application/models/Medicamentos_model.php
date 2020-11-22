<?php

class Medicamentos_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'medicamentos';
    }
    
    public function get($id){
        
        $this->db->where('id', $id);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()==1){
            $row = $query->row();
            $row->id = (int)$row->id;
            $row->insulina_nph = (int)$row->insulina_nph;
            $row->insulina_rapida = (int)$row->insulina_rapida;
            $row->metformina = (int)$row->metformina;
            $row->glibenclamida = (int)$row->glibenclamida;
            $row->enalapril = (int)$row->enalapril;
            $row->atenolol = (int)$row->atenolol;
            $row->hidroclorotiazida = (int)$row->hidroclorotiazida;
            $row->aas = (int)$row->aas;
            $row->simvastatina = (int)$row->simvastatina;
            $row->fenofibrato = (int)$row->fenofibrato;
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

