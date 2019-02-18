<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Factura model.
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("factura")
 * 
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Factura extends Comprobante
{
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("array<PabloVeintimilla\FacturaEC\Model\FacturaDetalle>")
     * @JMSSerializer\XmlList(entry = "detalle")
     *
     * @var Detalle[]
     */
    private $detalles = [];

    /**
     * @return \DateTime
     */
    public function getFechaEmision()
    {
        return $this->tributaria;
    }

    /**
     * @param \DateTime $fechaEmision
     */
    public function setFechaEmision(\DateTime $fechaEmision)
    {
        $this->tributaria = $fechaEmision;

        return $this;
    }

    public function getDetalles()
    {
        return $this->detalles;
    }

    public function setDetalles($detalles)
    {
        $this->detalles = $detalles;

        return $this;
    }
}
