<?php

namespace PabloVeintimilla\FacturaEC\Model;

/**
 * Generic class that represent Comprobante electrónico
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 * @license https://spdx.org/licenses/AGPL-3.0-or-later.html AGPL-3.0-or-later
 */
abstract class Comprobante
{
    private $numeroComprobante;
    private $razonSocial;

    /**
     * @var string
     */
    private $numeroRUC;

    /**
     * @var \DateTime Date of issue of comprobante
     */
    private $fechaEmision;

    /**
     * @var string Number of type: 01 factura, 04 note de crédito
     */
    private $tipoComprobante;
    private $tipoAmbiente;
    private $serie;
    private $codigoNumerico;
    private $tipoEmision;
    private $digitoVerificador;

    /**
     * @param  \DateTime $fechaEmision
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
     * @access    public
     * @ParamType $tipoComprobante string
     */
    public function setTipoComprobante($tipoComprobante)
    {
        $this->tipoComprobante = $tipoComprobante;
        return $this;
    }

    /**
     * @access     public
     * @return     string
     * @ReturnType string
     */
    public function getTipoComprobante()
    {
        return $this->tipoComprobante;
    }

    public function getNumeroComprobante()
    {
        return $this->numeroComprobante;
    }

    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    public function getNumeroRUC()
    {
        return $this->numeroRUC;
    }

    public function getTipoAmbiente()
    {
        return $this->tipoAmbiente;
    }

    public function getSerie()
    {
        return $this->serie;
    }

    public function getCodigoNumerico()
    {
        return $this->codigoNumerico;
    }

    public function getTipoEmision()
    {
        return $this->tipoEmision;
    }

    public function getDigitoVerificador()
    {
        return $this->digitoVerificador;
    }

    public function setNumeroComprobante($numeroComprobante)
    {
        $this->numeroComprobante = $numeroComprobante;
        return $this;
    }

    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;
        return $this;
    }

    public function setNumeroRUC($numeroRUC)
    {
        $this->numeroRUC = $numeroRUC;
        return $this;
    }

    public function setTipoAmbiente($tipoAmbiente)
    {
        $this->tipoAmbiente = $tipoAmbiente;
        return $this;
    }

    public function setSerie($serie)
    {
        $this->serie = $serie;
        return $this;
    }

    public function setCodigoNumerico($codigoNumerico)
    {
        $this->codigoNumerico = $codigoNumerico;
        return $this;
    }

    public function setTipoEmision($tipoEmision)
    {
        $this->tipoEmision = $tipoEmision;
        return $this;
    }

    public function setDigitoVerificador($digitoVerificador)
    {
        $this->digitoVerificador = $digitoVerificador;
        return $this;
    }
}
