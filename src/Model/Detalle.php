<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Detalle de comprobante electrónico.
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("detalle")
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Detalle
{
    /**
     * @var Comprobante Referencia a objeto comprobante
     */
    private $comprobante;

    /**
     * Comprobante object.
     *
     * @param Comprobante $comprobante
     */
    public function __construct(Comprobante $comprobante)
    {
        $this->comprobante = $comprobante;
    }

    public function getComprobante(): Comprobante
    {
        return $this->comprobante;
    }

    public function setComprobante(Comprobante $comprobante)
    {
        $this->comprobante = $comprobante;

        return $this;
    }
}
