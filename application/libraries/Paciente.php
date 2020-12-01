<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente
{
    protected $id;
    protected $dni;
    protected $nombre;
    protected $fechaNacimiento;
    protected $genero;
    protected $estadoCivil;
    protected $obraSocial;
    protected $estudios;
    protected $domicilio;
    protected $telefono;
    protected $localidad;
    protected $departamento;
    
    public function getId()
    {
        return $this->id;
    }
    
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

