<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;
use Elao\Enum\Bridge\Symfony\Validator\Constraint\Enum as AssertEnum;
use PabloVeintimilla\FacturaEC\Model\Enum\TipoComprobante;

/**
 * Contiene la informacion tributaria generica.
 * 
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("infoTributaria")
 * 
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Tributaria
{
    private $numeroComprobante;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     */
    private $razonSocial;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("ruc")
     */
    private $numeroRUC;
    /**
     * Tipo de comprobante.
     * 
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codDoc")
     *
     * @AssertEnum(class="\PabloVeintimilla\FacturaEC\Model\Enum\TipoComprobante", asValue=true)
     *
     * @var Enum\TipoComprobante
     */
    private $tipoComprobante;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("ambiente")
     */
    private $tipoAmbiente;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("secuencial")
     */
    private $serie;
    /**
     * @var string
     */
    private $codigoNumerico;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     */
    private $tipoEmision;
    private $digitoVerificador;

    /**
     * @param TipoComprobante $tipoComprobante Enumeración de tipo comprobante
     *
     * @return $this
     *
     * @throws \UnexpectedValueException
     */
    public function setTipoComprobante($tipoComprobante)
    {
        if (!TipoComprobante::accepts($tipoComprobante)) {
            throw new \UnexpectedValueException("Invalid 'TipoComprobante' value $tipoComprobante");
        }
        $this->tipoComprobante = $tipoComprobante;

        return $this;
    }

    /**
     * @return string
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

    /**
     * @param string $numeroComprobante
     *
     * @return $this
     */
    public function setNumeroComprobante($numeroComprobante)
    {
        $this->numeroComprobante = $numeroComprobante;

        return $this;
    }

    /**
     * @param string $razonSocial
     *
     * @return $this
     */
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
