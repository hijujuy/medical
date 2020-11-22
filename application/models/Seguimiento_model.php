<?php

class Seguimiento_model extends CI_Model
{
    private $mytable;
    
    public function __construct(){
        parent::__construct();
        $this->mytable = 'seguimiento';
    }
    
    public function get($id_historial){
        
        $this->db->where('id_historial', $id_historial);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()>0){
            
            foreach ($query->result() as $seguimiento) {
                $seguimiento->id = (int)$seguimiento->id;
                $seguimiento->adherencia_al_tratamiento = (int)$seguimiento->adherencia_al_tratamiento;
                $seguimiento->ecg = (int)$seguimiento->ecg;
                $seguimiento->riesgo_cardiovascular = (int)$seguimiento->riesgo_cardiovascular;
                $seguimiento->automonitoreo = (int)$seguimiento->automonitoreo;
                $seguimiento->id_historial = (int)$seguimiento->id_historial;
                $seguimiento->datos_clinicos = $this->datos_clinicos_model->get($seguimiento->id);
                $seguimiento->datos_laboratorio = $this->datos_laboratorio_model->get($seguimiento->id);
                $seguimiento->medicamentos = $this->medicamentos_model->get($seguimiento->id);
            }
            return $query->result();
            
        }else{
            return NULL;
        }
    }
    
    public function getById($id){
        
        $this->db->where('id', $id);
        
        $query = $this->db->get($this->mytable);
        
        if (!is_null($query) && $query->num_rows()==1){            
            $seguimiento = $query->row();
            $seguimiento->id = (int)$seguimiento->id;
            $seguimiento->adherencia_al_tratamiento = (int)$seguimiento->adherencia_al_tratamiento;
            $seguimiento->ecg = (int)$seguimiento->ecg;
            $seguimiento->riesgo_cardiovascular = (int)$seguimiento->riesgo_cardiovascular;
            $seguimiento->automonitoreo = (int)$seguimiento->automonitoreo;
            $seguimiento->id_historial = (int)$seguimiento->id_historial;
            $seguimiento->datos_clinicos = $this->datos_clinicos_model->get($seguimiento->id);
            $seguimiento->datos_laboratorio = $this->datos_laboratorio_model->get($seguimiento->id);
            $seguimiento->medicamentos = $this->medicamentos_model->get($seguimiento->id);
            return $seguimiento;
            
        }else{
            return null;
        }
    }
    
    public function save($id_historial) {
        
        $data = array('id_historial' => $id_historial);
        
        $query = $this->db->insert($this->mytable, $data);
        
        if ($query && $this->db->affected_rows()==1){
            $new_id = $this->db->insert_id();
            $datos_clinicos = $this->datos_clinicos_model->save($new_id);
            $datos_laboratorio = $this->datos_laboratorio_model->save($new_id);
            $medicamentos = $this->medicamentos_model->save($new_id);
            $retorno = $this->getById($new_id);            
            return $retorno;
        }else{
            
            return null;
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

