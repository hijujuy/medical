<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratorio_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'laboratorio';
    }
    
    public function get($id){
        
        $this->db->where('id', $id);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()==1){
            $row = $query->row();            
            $row->id = (int)$row->id;
            $row->glucemia_en_ayunas = (float)$row->glucemia_en_ayunas;
            $row->creatinina = (float)$row->creatinina;
            $row->urea = (float)$row->urea;
            $row->colesterol_total = (int)$row->colesterol_total;
            $row->trigliceridos = (int)$row->trigliceridos;
            $row->iga_total = (int)$row->iga_total;
            $row->ptog_desde = (int)$row->ptog_desde;
            $row->ptog_hasta = (int)$row->ptog_hasta;
            $row->colesterol_hdl = (int)$row->colesterol_hdl;
            $row->colesterol_ldl = (int)$row->colesterol_ldl;
            $row->got = (int)$row->got;
            $row->gpt = (int)$row->gpt;
            $row->antitransglutaminasa = (int)$row->antitransglutaminasa;
            $row->hba1c = (int)$row->hba1c;
            $row->fal = (int)$row->fal;
            $row->clearence_de_creatinina = (int)$row->clearence_de_creatinina;
            $row->fg = (int)$row->fg;
            $row->proteinuria = (int)$row->proteinuria;
            $row->proteinuria_creatininuria = (int)$row->proteinuria_creatininuria;
            $row->microalbuminuria = (float)$row->microalbuminuria;
            $row->nivel_de_riesgo_cardiovascular_global = (int)$row->nivel_de_riesgo_cardiovascular_global;
            $row->participacion_talleres_autocuidado = (int)$row->participacion_talleres_autocuidado;
            
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