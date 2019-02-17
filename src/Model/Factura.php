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
class Factura implements Comprobante
{
    /**
     * @var Tributaria Información tributaria genérica
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("PabloVeintimilla\FacturaEC\Model\Tributaria")
     * @JMSSerializer\SerializedName("infoTributaria")
     */
    private $tributaria;
    /**
     * @var Tributaria Información tributaria genérica
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("DateTime")
     */
    private $fechaEmision;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("array<PabloVeintimilla\FacturaEC\Model\FacturaDetalle>")
     * @JMSSerializer\XmlList(entry = "detalle")
     *
     * @var Detalle[]
     */
    private $detalles = [];

    public function getTributaria(): Tributaria
    {
        return $this->tributaria;
    }

    public function setTributaria(Tributaria $tributaria)
    {
        $this->tributaria = $tributaria;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getFechaEmision()
    {
        return $this->fechaEmision;
    }

    /**
     * @param \DateTime $fechaEmision
     */
    public function setFechaEmision(\DateTime $fechaEmision)
    {
        $this->fechaEmision = $fechaEmision;

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
