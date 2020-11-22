<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Factores_de_riesgo_asociados
{
    private $id;
    private $obesidad;
    private $sedentarismo;
    private $tabaco;
    private $alcoholismo;
    private $anticoagulantes;
    private $corticoides;
    private $anticonceptivos;
    private $menospausia_prematura;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getObesidad()
    {        
        return $this->obesidad;
    }

    /**
     * @return mixed
     */
    public function getSedentarismo()
    {
        return $this->sedentarismo;
    }

    /**
     * @return mixed
     */
    public function getTabaco()
    {
        return $this->tabaco;
    }

    /**
     * @return mixed
     */
    public function getAlcoholismo()
    {
        return $this->alcoholismo;
    }

    /**
     * @return mixed
     */
    public function getAnticoagulantes()
    {
        return $this->anticoagulantes;
    }

    /**
     * @return mixed
     */
    public function getCorticoides()
    {
        return $this->corticoides;
    }

    /**
     * @return mixed
     */
    public function getAnticonceptivos()
    {
        return $this->anticonceptivos;
    }

    /**
     * @return mixed
     */
    public function getMenospausia_prematura()
    {
        return $this->menospausia_prematura;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $obesidad
     */
    public function setObesidad($obesidad)
    {   
        if ($obesidad==0) $this->obesidad = false;
        else $this->obesidad =true;
    }

    /**
     * @param mixed $sedentarismo
     */
    public function setSedentarismo($sedentarismo)
    {
        if ($sedentarismo==0) $this->sedentarismo = false;
        $this->sedentarismo = true;
    }

    /**
     * @param mixed $tabaco
     */
    public function setTabaco($tabaco)
    {
        if ($tabaco==0) $this->tabaco = false;
        else $this->tabaco = true;
    }

    /**
     * @param mixed $alcoholismo
     */
    public function setAlcoholismo($alcoholismo)
    {
        if ($alcoholismo==0)$this->alcoholismo = false;
        else $this->alcoholismo = true;
    }

    /**
     * @param mixed $anticoagulantes
     */
    public function setAnticoagulantes($anticoagulantes)
    {
        if ($anticoagulantes==0) $this->anticoagulantes = FALSE;
        else $this->anticoagulantes = TRUE;
    }

    /**
     * @param mixed $corticoides
     */
    public function setCorticoides($corticoides)
    {
        if ($corticoides==0)$this->corticoides = FALSE;
        else $this->corticoides = TRUE;
    }

    /**
     * @param mixed $anticonceptivos
     */
    public function setAnticonceptivos($anticonceptivos)
    {
        if ($anticonceptivos==0) $this->anticonceptivos = FALSE;
        else $this->anticonceptivos = TRUE;
    }

    /**
     * @param mixed $menospausia_prematura
     */
    public function setMenospausia_prematura($menospausia_prematura)
    {
        if ($menospausia_prematura==0) $this->menospausia_prematura = FALSE;
        else $this->menospausia_prematura = TRUE;
    }

        
}

