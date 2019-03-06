<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Tax model (Contiene la informacion de los impuestos).
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("impuesto")
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Tax
{
    /**
     * @var string Establecimiento
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codigo")
     */
    private $code;
    /**
     * @var string Establecimiento
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codigoPorcentaje")
     */
    private $percentageCode;
    /**
     * @var string Establecimiento
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("tarifa")
     * @JMSSerializer\SkipWhenEmpty
     */
    private $rate;
    /**
     * @var float Aply in total tax
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("descuentoAdicional")
     * @JMSSerializer\SkipWhenEmpty
     */
    private $discount;
    /**
     * @var float Base imponible
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("baseImponible")
     */
    private $base;
    /**
     * @var string Valor
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("valor")
     */
    private $value;

    public function getCode()
    {
        return $this->code;
    }

    public function getPercentageCode()
    {
        return $this->percentageCode;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getBase()
    {
        return $this->base;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function setPercentageCode($percentageCode)
    {
        $this->percentageCode = $percentageCode;
        return $this;
    }

    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
        return $this;
    }

    public function setBase($base)
    {
        $this->base = $base;
        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}
