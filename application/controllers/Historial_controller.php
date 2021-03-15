<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/Format.php';

/**
 * @author diego
 *
 */
class Historial_controller extends REST_Controller
{
    
    /**
     * Constructor vacio de controlador de historiales 
     */
    public function __construct(){        
        parent::__construct();        
    }
        
    /**
     * @param int $id
     */
    public function index_get($id = null)
    {
        
        if (is_null($id))
        {
            $this->response("No se proporciono el parametro 'id' de la consulta", 400);
        }
        
        $query = $this->historial_model->get($id);
        $paciente = $this->paciente_model->get($id);
        $diagnosticos = $this->diagnosticos_model->get($id);
        $enfermedades_asociadas = $this->enfermedades_asociadas_model->get($id);
        $factores_de_riesgo_asociados = $this->factores_de_riesgo_asociados_model->get($id);
        $antecedentes_familiares = $this->antecedentes_familiares_model->get($id);
        $odontologia = $this->odontologia_model->get($id);
        $nutricion = $this->nutricion_model->get($id);
        $psicologia = $this->psicologia_model->get($id);
        $enfermeria = $this->enfermeria_model->get($id);
        $oftalmologia = $this->oftalmologia_model->get($id);
        $circulatorio = $this->circulatorio_model->get($id);
        $renal = $this->renal_model->get($id);
        $examen_fisico = $this->examen_fisico_model->get($id);
        $complicaciones_agudas_de_diabetes = $this->complicaciones_agudas_de_diabetes_model->get($id);
        $laboratorio = $this->laboratorio_model->get($id);
        $internaciones_relacionadas_con_enfermedad_de_base = $this->internaciones_relacionadas_con_enfermedad_de_base_model->get($id);
        $tratamiento_actual = $this->tratamiento_actual_model->get($id);
        $conducta_medica = $this->conducta_medica_model->get($id);
        $solicitud_interconsulta = $this->solicitud_interconsulta_model->get($id);
        $inmunizaciones = $this->inmunizaciones_model->get($id);
        $solicitud_practica = $this->solicitud_practica_model->get($id);
        $seguimientos = $this->seguimiento_model->get($id);
        $obra_sociales = $this->obra_social_model->get();
        $estado_civiles = $this->estado_civil_model->get();
        $departamentos = $this->departamento_model->get();
        $localidades = $this->localidad_model->get();
        $enfermedades = $this->enfermedad_model->getAll();
        
        $historial = array(
            'historial' => $query,
            'paciente' => $paciente,
            'diagnosticos' => $diagnosticos,
            'enfermedades_asociadas' => $enfermedades_asociadas,
            'factores_de_riesgo_asociados' => $factores_de_riesgo_asociados,
            'antecedentes_familiares' => $antecedentes_familiares,
            'odontologia' => $odontologia,
            'nutricion' => $nutricion,
            'psicologia' => $psicologia,
            'enfermeria' => $enfermeria,
            'oftalmologia' => $oftalmologia,
            'circulatorio' => $circulatorio,
            'renal' => $renal,
            'examen_fisico' => $examen_fisico,
            'complicaciones_agudas_de_diabetes' => $complicaciones_agudas_de_diabetes,
            'laboratorio' => $laboratorio,
            'internaciones_relacionadas_con_enfermedad_de_base' => $internaciones_relacionadas_con_enfermedad_de_base,
            'tratamiento_actual' => $tratamiento_actual,
            'conducta_medica' => $conducta_medica,
            'solicitud_interconsulta' => $solicitud_interconsulta,
            'inmunizaciones' => $inmunizaciones,
            'solicitud_practica' => $solicitud_practica,
            'seguimientos' => $seguimientos,
            'obra_sociales' => $obra_sociales,
            'estado_civiles' => $estado_civiles,
            'departamentos' => $departamentos,
            'localidades' => $localidades,
            'enfermedades' => $enfermedades
        );
        
        if (!is_null($query))
        {
            $this->response($historial, 200);
        }
        else
        {
            $this->response(array('error' => "ID historial no encontrado"), 400);
        }
        
    }//End function index_get
    
    public function create_post(){        
        $hospital_id = $this->post('hospital_id');
        $paciente = $this->post('paciente');        
        $id = $this->paciente_model->save($paciente);
        $this->historial_model->save($id, $hospital_id);
        $this->diagnosticos_model->save($id);
        $this->enfermedades_asociadas_model->save($id);
        $this->factores_de_riesgo_asociados_model->save($id);
        $this->antecedentes_familiares_model->save($id);
        $this->odontologia_model->save($id);
        $this->nutricion_model->save($id);
        $this->psicologia_model->save($id);
        $this->enfermeria_model->save($id);
        $this->oftalmologia_model->save($id);
        $this->circulatorio_model->save($id);
        $this->renal_model->save($id);
        $this->examen_fisico_model->save($id);
        $this->complicaciones_agudas_de_diabetes_model->save($id);
        $this->laboratorio_model->save($id);
        //$this->internaciones_relacionadas_con_enfermedad_de_base_model->save_empty($id);
        $this->tratamiento_actual_model->save($id);
        //$this->conducta_medica_model->save($id);
        $this->solicitud_interconsulta_model->save($id);
        $this->inmunizaciones_model->save($id);
        $this->solicitud_practica_model->save($id);
        //$id_seguimiento = $this->seguimiento_model->save($id);
        //$this->datos_clinicos_model->save($id_seguimiento);
        //$this->datos_laboratorio_model->save($id_seguimiento);
        //$this->medicamentos_model->save($id_seguimiento);
        
        $this->response(array('id'=>$id), 200);
    }
    
    public function index_post($id = NULL)
    {
        if (is_null($id) || !$this->post('data'))
        {
            $this->response(array('error' => "No se recibió el objeto post o ID"), 400);
        }
        else
        {
            $data = $this->post('data');
            
            if ($this->historial_model->save($id, $data['hospital_id']))
            {
                $this->response(array('response'  => 'Historial creado exitosamente'), 201);
            }
            else {
                $this->response(array('error' =>"Surgio un error de servidor"), 400);
            }
            
        }
    }//End function index_post
        
    public function update_post($id = NULL) {
        
        if (!$this->post('data') || !$id)
        {
            $this->response(array('error' => 'No se proporciono el id el post(data)'), 400);
        }
        
        $query = $this->mymodel->update($id, $this->post('data'));
        
        if (!is_null($query))
        {
            if ($query['update'])
            {
                $this->response(array('value' => $query['value']), 200);
            }
            else
            {
                $this->response(array('error' => $query['value']), 400);
            }
        }
        else
        {
            $this->response(array('error' => 'Campo seleccionado es inexistente'), 404);
        }
    }
            
}

