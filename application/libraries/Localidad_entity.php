<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Localidad_entity
{
    private $id;
    
    private $descripcion;
    
    private $codigo_postal;
    
    private $departamento_id;
        
    /** 
     * @return number  
     */
    public function getId()
    { 
        return $this->id; 
    }
    
    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @return number
     */
    public function getCodigo_postal()
    {
        return $this->codigo_postal;
    }

    /**
     * @return number
     */
    public function getDepartamento_id()
    {
        return $this->departamento_id;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @param number $codigo_postal
     */
    public function setCodigo_postal($codigo_postal)
    {
        $this->codigo_postal = $codigo_postal;
    }

    /**
     * @param number $departamento_id
     */
    public function setDepartamento_id($departamento_id)
    {
        $this->departamento_id = $departamento_id;
    }
    
}

