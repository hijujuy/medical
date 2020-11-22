<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author diego
 *
 */
class Diagnosticos_entity
{    
    private $id;
    
    private $glucemia_alterada_en_ayunas;
    
    private $tolerancia_glucosa_alterada;
    
    private $diabetes;
    
    private $diabetes_tiempo_evolucion;
    
    private $diabetes_tipo;
    
    private $diabetes_semanas_gestacion;
    
    private $hipertension_alterial;
    
    private $hipertension_arterial_tiempo_evolucion;
    
    private $dislipemia;
    
    private $preclasificacion_rcvg;
    
    const ID_DIABETES_GESTACIONAL = 1;
    

    public function __construct()
    {        
        $this->glucemia_alterada_en_ayunas = false;
        
        $this->tolerancia_glucosa_alterada = false;
        
        $this->diabetes = false;
        
        $this->diabetes_tiempo_evolucion = 0;
        
        $this->diabetes_tipo = 0;
        
        $this->diabetes_semanas_gestacion = 0;
        
        $this->hipertension_alterial = false;
        
        $this->hipertension_arterial_tiempo_evolucion = 0;
        
        $this->dislipemia = false;
        
        $this->preclasificacion_rcvg = 0;
    }
    
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * @return mixed
     */
    public function getGlucemia_alterada_en_ayunas()
    {
        return $this->glucemia_alterada_en_ayunas;
    }

    /**
     * @return mixed
     */
    public function getTolerancia_glucosa_alterada()
    {
        return $this->tolerancia_glucosa_alterada;
    }

    /**
     * @return mixed
     */
    public function getDiabetes()
    {
        return $this->diabetes;
    }

    /**
     * @return mixed
     */
    public function getDiabetes_tiempo_evolucion()
    {
        return $this->diabetes_tiempo_evolucion;
    }
    
    /**
     * @return mixed
     */
    public function getDiabetes_tipo()
    {
        return $this->diabetes_tipo;
    }
    
    /**
     * @return mixed
     */
    public function getDiabetes_semanas_gestacion()
    {
        return $this->diabetes_semanas_gestacion;
    }

    /**
     * @return mixed
     */
    public function getHipertension_alterial()
    {
        return $this->hipertension_alterial;
    }

    /**
     * @return mixed
     */
    public function getHipertension_arterial_tiempo_evolucion()
    {
        return $this->hipertension_arterial_tiempo_evolucion;
    }

    /**
     * @return mixed
     */
    public function getDislipemia()
    {
        return $this->dislipemia;
    }

    /**
     * @return mixed
     */
    public function getPreclasificacion_rcvg()
    {
        return $this->preclasificacion_rcvg;
    }

    
    /**
     * @param mixed $glucemia_alterada_en_ayunas
     */
    public function setGlucemia_alterada_en_ayunas($glucemia_alterada_en_ayunas)
    {
        $this->glucemia_alterada_en_ayunas = $glucemia_alterada_en_ayunas;
    }

    /**
     * @param mixed $tolerancia_glucosa_alterada
     */
    public function setTolerancia_glucosa_alterada($tolerancia_glucosa_alterada)
    {
        $this->tolerancia_glucosa_alterada = $tolerancia_glucosa_alterada;
    }

    /**
     * @param mixed $diabetes
     */
    public function setDiabetes($diabetes)
    {
        $this->diabetes = $diabetes;
    }

    /**
     * @param mixed $diabetes_tiempo_evolucion
     */
    public function setDiabetes_tiempo_evolucion($diabetes_tiempo_evolucion)
    {
        if ($this->diabetes == true)
        {
            $this->diabetes_tiempo_evolucion = $diabetes_tiempo_evolucion;
        }
    }
    
    /**
     * @param mixed $diabetes_tipo
     */
    public function setDiabetes_tipo($diabetes_tipo)
    {
        if ($this->diabetes == true)
        {
            $this->diabetes_tipo = $diabetes_tipo;
        }
    }
    
    /**
     * @param mixed $diabetes_semanas_gestacion
     */
    public function setDiabetes_semanas_gestacion($diabetes_semanas_gestacion)
    {
        //constante tipo de diabetes == "diabetes gestacional"
        if ($this->diabetes_tipo == ID_DIABETES_GESTACIONAL)
        {
            $this->diabetes_semanas_gestacion = $diabetes_semanas_gestacion;
        }
    }

    /**
     * @param mixed $hipertension_alterial
     */
    public function setHipertension_alterial($hipertension_alterial)
    {
        $this->hipertension_alterial = $hipertension_alterial;
    }

    /**
     * @param mixed $hipertension_arterial_tiempo_evolucion
     */
    public function setHipertension_arterial_tiempo_evolucion($hipertension_arterial_tiempo_evolucion)
    {
        if ($this->hipertension_alterial == true)
        {
            $this->hipertension_arterial_tiempo_evolucion = $hipertension_arterial_tiempo_evolucion;
        }
    }

    /**
     * @param mixed $dislipemia
     */
    public function setDislipemia($dislipemia)
    {
        $this->dislipemia = $dislipemia;
    }

    /**
     * @param mixed $preclasificacion_rcvg
     */
    public function setPreclasificacion_rcvg($preclasificacion_rcvg)
    {
        $this->preclasificacion_rcvg = $preclasificacion_rcvg;
    }
    
    
    
}

