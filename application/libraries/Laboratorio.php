<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laboratorio
{
    private $id;    
    private $glucemia_en_ayunas;
    private $colesterol_total;    
    private $trigliceridos;    
    private $iga_total;    
    private $ptog_desde;    
    private $ptog_hasta;    
    private $colesterol_hdl;    
    private $colesterol_ldl;    
    private $got;    
    private $gpt;    
    private $antitransglutaminasa;    
    private $hba1c;    
    private $fal;    
    private $creatinina;    
    private $clearence_de_creatinina;    
    private $fg;    
    private $proteinuria;    
    private $proteinuria_creatininuria;    
    private $urea;    
    private $microalbuminuria;    
    private $nivel_de_riesgo_cardiovascular_global;        
    private $participacion_talleres_autocuidado;    
    private $observaciones;
    
    public function __construct($row){
        $this->setId((int)$row->id);
        $this->setGlucemia_en_ayunas((float)$row->glucemia_en_ayunas);
        $this->setColesterol_total((float)$row->colesterol_total);
        $this->setTrigliceridos((float)$row->trigliceridos);
        $this->setIga_total((float)$row->iga_total);
        $this->setPtog_desde((float)$row->ptog_desde);
        $this->setPtog_hasta((float)$row->ptog_hasta);
        $this->setColesterol_hdl((float)$row->colesterol_hdl);
        $this->setColesterol_ldl((float)$row->colesterol_ldl);
        $this->setGot((float)$row->got);
        $this->setGpt((float)$row->gpt);
        $this->setAntitransglutaminasa((float)$row->antitransglutaminasa);
        $this->setHba1c((float)$row->hba1c);
        $this->setFal((float)$row->fal);
        $this->setCreatinina((float)$row->creatinina);
        $this->setClearence_de_creatinina((float)$row->clearence_de_creatinina);
        $this->setFg((float)$row->fg);
        $this->setProteinuria((float)$row->proteinuria);
        $this->setProteinuria_creatininuria((float)$row->proteinuria_creatininuria);
        $this->setUrea((float)$row->urea);
        $this->setMicroalbuminuria((float)$row->microalbuminuria);
        $this->setNivel_de_riesgo_cardiovascular_global((int)$row->nivel_de_riesgo_cardiovascular_global);
        $this->setParticipacion_talleres_autocuidado((int)$row->participacion_talleres_autocuidado);
        $this->setObservaciones($observaciones);
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
        $this->id = (int)$id;
    }

    /**
     * @return mixed
     */
    public function getGlucemia_en_ayunas()
    {
        return $this->glucemia_en_ayunas;
    }

    /**
     * @param mixed $glucemia_en_ayunas
     */
    public function setGlucemia_en_ayunas($glucemia_en_ayunas)
    {
        $this->glucemia_en_ayunas = (float)$glucemia_en_ayunas;
    }

    /**
     * @return mixed
     */
    public function getColesterol_total()
    {
        return $this->colesterol_total;
    }

    /**
     * @param mixed $colesterol_total
     */
    public function setColesterol_total($colesterol_total)
    {
        $this->colesterol_total = (float)$colesterol_total;
    }

    /**
     * @return mixed
     */
    public function getTrigliceridos()
    {
        return $this->trigliceridos;
    }

    /**
     * @param mixed $trigliceridos
     */
    public function setTrigliceridos($trigliceridos)
    {
        $this->trigliceridos = (float)$trigliceridos;
    }

    /**
     * @return mixed
     */
    public function getIga_total()
    {
        return $this->iga_total;
    }

    /**
     * @param mixed $iga_total
     */
    public function setIga_total($iga_total)
    {
        $this->iga_total = (float)$iga_total;
    }

    /**
     * @return mixed
     */
    public function getPtog_desde()
    {
        return $this->ptog_desde;
    }

    /**
     * @param mixed $ptog_desde
     */
    public function setPtog_desde($ptog_desde)
    {
        $this->ptog_desde = (float)$ptog_desde;
    }

    /**
     * @return mixed
     */
    public function getPtog_hasta()
    {
        return $this->ptog_hasta;
    }

    /**
     * @param mixed $ptog_hasta
     */
    public function setPtog_hasta($ptog_hasta)
    {
        $this->ptog_hasta = (float)$ptog_hasta;
    }

    /**
     * @return mixed
     */
    public function getColesterol_hdl()
    {
        return $this->colesterol_hdl;
    }

    /**
     * @param mixed $colesterol_hdl
     */
    public function setColesterol_hdl($colesterol_hdl)
    {
        $this->colesterol_hdl = (float)$colesterol_hdl;
    }

    /**
     * @return mixed
     */
    public function getColesterol_ldl()
    {
        return $this->colesterol_ldl;
    }

    /**
     * @param mixed $colesterol_ldl
     */
    public function setColesterol_ldl($colesterol_ldl)
    {
        $this->colesterol_ldl = (float)$colesterol_ldl;
    }

    /**
     * @return mixed
     */
    public function getGot()
    {
        return $this->got;
    }

    /**
     * @param mixed $got
     */
    public function setGot($got)
    {
        $this->got = (float)$got;
    }

    /**
     * @return mixed
     */
    public function getGpt()
    {
        return $this->gpt;
    }

    /**
     * @param mixed $gpt
     */
    public function setGpt($gpt)
    {
        $this->gpt = (float)$gpt;
    }

    /**
     * @return mixed
     */
    public function getAntitransglutaminasa()
    {
        return $this->antitransglutaminasa;
    }

    /**
     * @param mixed $antitransglutaminasa
     */
    public function setAntitransglutaminasa($antitransglutaminasa)
    {
        $this->antitransglutaminasa = (float)$antitransglutaminasa;
    }

    /**
     * @return mixed
     */
    public function getHba1c()
    {
        return $this->hba1c;
    }

    /**
     * @param mixed $hba1c
     */
    public function setHba1c($hba1c)
    {
        $this->hba1c = (float)$hba1c;
    }

    /**
     * @return mixed
     */
    public function getFal()
    {
        return $this->fal;
    }

    /**
     * @param mixed $fal
     */
    public function setFal($fal)
    {
        $this->fal = (float)$fal;
    }

    /**
     * @return mixed
     */
    public function getCreatinina()
    {
        return $this->creatinina;
    }

    /**
     * @param mixed $creatinina
     */
    public function setCreatinina($creatinina)
    {
        $this->creatinina = (float)$creatinina;
    }

    /**
     * @return mixed
     */
    public function getClearence_de_creatinina()
    {
        return $this->clearence_de_creatinina;
    }

    /**
     * @param mixed $clearence_de_creatinina
     */
    public function setClearence_de_creatinina($clearence_de_creatinina)
    {
        $this->clearence_de_creatinina = (float)$clearence_de_creatinina;
    }

    /**
     * @return mixed
     */
    public function getFg()
    {
        return $this->fg;
    }

    /**
     * @param mixed $fg
     */
    public function setFg($fg)
    {
        $this->fg = (float)$fg;
    }

    /**
     * @return mixed
     */
    public function getProteinuria()
    {
        return $this->proteinuria;
    }

    /**
     * @param mixed $proteinuria
     */
    public function setProteinuria($proteinuria)
    {
        $this->proteinuria = (float)$proteinuria;
    }

    /**
     * @return mixed
     */
    public function getProteinuria_creatininuria()
    {
        return $this->proteinuria_creatininuria;
    }

    /**
     * @param mixed $proteinuria_creatininuria
     */
    public function setProteinuria_creatininuria($proteinuria_creatininuria)
    {
        $this->proteinuria_creatininuria = (float)$proteinuria_creatininuria;
    }

    /**
     * @return mixed
     */
    public function getUrea()
    {
        return $this->urea;
    }

    /**
     * @param mixed $urea
     */
    public function setUrea($urea)
    {
        $this->urea = (float)$urea;
    }

    /**
     * @return mixed
     */
    public function getMicroalbuminuria()
    {
        return $this->microalbuminuria;
    }

    /**
     * @param mixed $microalbuminuria
     */
    public function setMicroalbuminuria($microalbuminuria)
    {
        $this->microalbuminuria = (float)$microalbuminuria;
    }

    /**
     * @return mixed
     */
    public function getNivel_de_riesgo_cardiovascular_global()
    {
        return $this->nivel_de_riesgo_cardiovascular_global;
    }

    /**
     * @param mixed $nivel_de_riesgo_cardiovascular_global
     */
    public function setNivel_de_riesgo_cardiovascular_global($nivel_de_riesgo_cardiovascular_global)
    {
        $this->nivel_de_riesgo_cardiovascular_global = (int)$nivel_de_riesgo_cardiovascular_global;
    }

    /**
     * @return mixed
     */
    public function getParticipacion_talleres_autocuidado()
    {
        return $this->participacion_talleres_autocuidado;
    }

    /**
     * @param mixed $participacion_talleres_autocuidado
     */
    public function setParticipacion_talleres_autocuidado($participacion_talleres_autocuidado)
    {
        $this->participacion_talleres_autocuidado = (int)$participacion_talleres_autocuidado;
    }

    /**
     * @return mixed
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param mixed $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }
    
}

