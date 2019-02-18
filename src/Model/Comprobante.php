<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Description of Comprobante.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Comprobante
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
     * Implementa el objeto detalle específico por tipo de comprobante.
     *
     * Detalle[].
     */
    abstract public function getDetalles();

    public function getTributaria(): Tributaria
    {
        return $this->tributaria;
    }

    public function setTributaria(Tributaria $tributaria)
    {
        $this->tributaria = $tributaria;

        return $this;
    }
}
