<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Historial_entity
{
    private $id;
    
    private $hospital_id;
        
    private $paciente;
    
    private $diagnosticos;
    
    public function __construct()
    {
        
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
    public function getHospital_id()
    {
        return $this->hospital_id;
    }

    /**
     * @param mixed $hospital_id
     */
    public function setHospital_id($hospital_id)
    {
        $this->hospital_id = $hospital_id;
    }
    /**
     * @return mixed
     */
    public function getPaciente()
    {
        return $this->paciente;
    }

    /**
     * @param mixed $paciente
     */
    public function setPaciente($paciente)
    {
        $this->paciente = $paciente;
    }

    /**
     * @return mixed
     */
    public function getDiagnosticos()
    {
        return $this->diagnosticos;
    }

    /**
     * @param mixed $diagnosticos
     */
    public function setDiagnosticos($diagnosticos)
    {
        $this->diagnosticos = $diagnosticos;
    }

    
    
       
}