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
     * @var float Aplly in total tax
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("descuentoAdicional")
     * @JMSSerializer\SkipWhenEmpty
     */
    private $discount;
    /**
     * @var string Código de porcentaje
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codigoPorcentaje")
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
}
