<?php

namespace PabloVeintimilla\FacturaEC\Model;

/**
 * Generic class that represent Comprobante electrónico
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Comprobante
{
    /**
     * @var \DateTime Date of issue of vaoucher
     */
    private $fechaEmision;

    /**
     * @var string Number of type: 01 factura, 04 note de crédito
     */
    private $tipoComprobante;

    /**
     * @var string
     */
    private $numeroRUC;
    private $tipoAmbiente;
    private $numeroComprobante;
    private $codigoNumerico;
    private $tipoEmision;

    /**
     * @access public
     * @param aFechaEmision
     */
    public function setFechaEmision(\DateTime $fechaEmision)
    {
        $this->fechaEmision = $fechaEmision;
        return $this;
    }

    /**
     *
     * @return \DateTime
     */
    public function getFechaEmision()
    {
        return $this->fechaEmision;
    }

    /**
     * @access public
     * @param string aTipoComprobante
     * @ParamType aTipoComprobante string
     */
    public function setTipoComprobante($tipoComprobante)
    {
        $this->tipoComprobante = $tipoComprobante;
        return $this;
    }

    /**
     * @access public
     * @return string
     * @ReturnType string
     */
    public function getTipoComprobante()
    {
        return $this->tipoComprobante;
    }
}
