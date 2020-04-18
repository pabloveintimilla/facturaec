<?php

namespace PabloVeintimilla\FacturaEC\Model;

class PayMethod
{

    /*
    *Attribute formaPago
    */
    private $code;

    /*
    *Attribute plazo
    */
    private $term;

    /*
    *Attribute unidadTiempo
    */
    private $unitTime;

    /*
    *Attribute total
    */
    private $value;

    /**
     * Get code/*
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code/*
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get term/*
     */ 
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Set term/*
     *
     * @return  self
     */ 
    public function setTerm($term)
    {
        $this->term = $term;

        return $this;
    }

    /**
     * Get unit_time/*
     */ 
    public function getUnitTime()
    {
        return $this->unitTime;
    }

    /**
     * Set unit_time/*
     *
     * @return  self
     */ 
    public function setUnitTime($unitTime)
    {
        $this->unitTime = $unitTime;

        return $this;
    }

    /**
     * Get value/*
     */ 
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value/*
     *
     * @return  self
     */ 
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
