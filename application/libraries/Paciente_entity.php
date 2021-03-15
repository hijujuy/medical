<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente_entity
{
    private $id;
    
    private $dni;
    
    private $nombre;
    
    private $fechaNacimiento;
    
    private $genero;
    
    private $estadoCivil;
    
    private $obraSocial;
    
    private $estudios;
    
    private $domicilio;
    
    private $telefono;
    
    private $localidad;
    
    private $departamento;
    
    public function __construct()
    {
        $this->dni = 0;
        $this->nombre = "";
        $this->fechaNacimiento = new \DateTime();
        $this->genero = 1;
        $this->estadoCivil = 1;
        $this->obraSocial = 1;
        $this->estudios = 1;
        $this->domicilio = "";
        $this->telefono = "";
        $this->localidad = 1;
        $this->departamento = 1;
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

    public function setDni($value)
    {
        if (is_integer($value))
        {
            $this->dni = $value;
        }
    }
    
    public function getDni()
    {
        return $this->dni;
    }
    
    public function setNombre($value)
    {
        $this->nombre = $value;
    }
    
    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function setFechaNacimiento($value)
    {
        $this->fechaNacimiento = $value;
    }
    
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }
    
    //private $genero;
    public function setGenero($value)
    {
        $this->genero = $value;
    }
    
    public function getGenero()
    {
        return $this->genero;
    }
    
    //private $estadoCivil;
    public function setEstadoCivil($value)
    {
        $this->estadoCivil = $value;
    }
    
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }
    
    //private $obraSocial;
    public function setObraSocial($value)
    {
        $this->obraSocial = $value;
    }
    
    public function getObraSocial()
    {
        return $this->obraSocial;
    }
    
    //private $estudios;
    public function setEstudios($value)
    {
        $this->estudios = $value;
    }
    
    public function getEstudios()
    {
        return $this->estudios;
    }
    
    //private $domicilio;
    public function setDomicilio($value)
    {
        $this->domicilio = $value;
    }
    
    public function getDomicilio()
    {
        return $this->domicilio;
    }
    
    //private $telefono;
    public function setTelefono($value)
    {
        $this->telefono = $value;
    }
    
    public function getTelefono()
    {
        return $this->telefono;
    }
    
    //private $localidad;
    public function setLocalidad($value) {
        $this->localidad = $value;
    }
    
    public function getLocalidad() {
        return $this->localidad;
    }
    
    //private $departamento;
    public function setDepartamento($value)
    {
        $this->departamento = $value;
    }
    
    public function getDepartamento()
    {
        return $this->departamento;
    }
}

