<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;
use Elao\Enum\Bridge\Symfony\Validator\Constraint\Enum as AssertEnum;
use PabloVeintimilla\FacturaEC\Model\Enum\VoucherType;
use PabloVeintimilla\FacturaEC\Model\Enum\EnviromentType;

/**
 * Generic seller attributes of voucher (Contiene la informacion tributaria generica).
 * 
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("infoTributaria")
 * 
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Seller
{
    /**
     * @var string Establecimiento
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("estab")
     */
    private $store;
    /**
     * @var string Punto de emisión
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("ptoEmi")
     */
    private $point;
    /**
     * @var string Número de comprobante
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("secuencial")
     */
    private $sequential;
    /**
     * @var string Razón social
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("razonSocial")
     */
    private $company;
    /**
     * @var string Nombre comercial
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("nombreComercial")
     */
    private $name;
    /**
     * @var string Registro unico de contribuyente (RUC)
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("ruc")
     */
    private $identification;
    /**
     * @var string Dirección matriz
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("dirMatriz")
     */
    private $address;
    /**
     * @var VoucherType Tipo de comprobante.
     * 
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codDoc")
     *
     * @AssertEnum(class="\PabloVeintimilla\FacturaEC\Model\Enum\VoucherType", asValue=true)
     */
    private $voucherType;
    /**
     * @var EnviromentType Desarrollo o produccion depende de en cual ambiente se genere el comprobante.
     * 
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("ambiente")
     *
     * @AssertEnum(class="\PabloVeintimilla\FacturaEC\Model\Enum\EnviromentType", asValue=true)
     */
    private $enviromentType;

    /**
     * @var string Tipo de emisión
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("tipoEmision")
     */
    private $emissionType;

    /**
     * Get store "Se detalla el numero del establecimiento".
     *
     * @return string
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Get point "Se detalla el numero del punto de emision".
     *
     * @return string
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Get sequential "Se detalla el secuencial del documento".
     *
     * @return string
     */
    public function getSequential()
    {
        return $this->sequential;
    }

    /**
     * Get company "Se detalla el numero de RUC del Contribuyente".
     * 
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Get name "nombre comercial".
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get identification "Numero de ruc del contribuyente".
     *
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * Get address "Dirección matriz".
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get voucher type "Tipo de comprobante".
     *
     * @return VoucherType
     */
    public function getVoucherType(): Enum\VoucherType
    {
        return $this->voucherType;
    }

    /**
     * Get enviromente type "Tipo de ambiente: Desarrollo o produccion depende
     * de en cual ambiente se genere el comprobante.".
     * 
     * @return EnviromentType
     */
    public function getEnviromentType()
    {
        return $this->enviromentType;
    }

    /**
     * Get emission type "Tipo de emision en el cual se genero el comprobante".
     * 
     * @return string
     */
    public function getEmissionType()
    {
        return $this->emissionType;
    }

    /**
     * Set store "Se detalla el numero del establecimiento".
     * 
     * @param string $store
     *
     * @return $this
     */
    public function setStore($store)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Set point "Se detalla el numero del punto de emision".
     * 
     * @param string $point
     *
     * @return $this
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Set sequential "Se detalla el secuencial del documento".
     *
     * @param string $number
     *
     * @return $this
     */
    public function setSequential($number)
    {
        $this->sequential = $number;

        return $this;
    }

    /**
     * Set company "Se detalla el numero de RUC del Contribuyente".
     *
     * @param string $company
     *
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Set name "nombre comercial".
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set identification "Numero de ruc del contribuyente".
     * 
     * @param string $identification
     *
     * @return $this
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;

        return $this;
    }

    /**
     * Set address "Dirección matriz".
     *
     * @param string $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Set voucher type "Tipo de comprobante".
     *
     * @param VoucherType $voucherType Enum VoucherType
     *
     * @return $this
     *
     * @throws \UnexpectedValueException
     */
    public function setVoucherType($voucherType)
    {
        if (!VoucherType::accepts($voucherType)) {
            throw new \UnexpectedValueException("Invalid Voucher type value: $voucherType");
        }
        $this->voucherType = $voucherType;

        return $this;
    }

    /**
     * Set enviromente type "Tipo de ambiente: Desarrollo o produccion depende
     * de en cual ambiente se genere el comprobante.".
     * 
     * @param EnviromentType $enviromentType
     *
     * @return $this
     */
    public function setEnviromentType($enviromentType)
    {
        if (!EnviromentType::accepts($enviromentType)) {
            throw new \UnexpectedValueException("Invalid enviroment type value: $enviromentType");
        }
        $this->enviromentType = $enviromentType;

        return $this;
    }

    /**
     * Set emission type "Tipo de emision en el cual se genero el comprobante".
     *
     * @param string $emissionType
     *
     * @return $this
     */
    public function setEmissionType($emissionType)
    {
        $this->emissionType = $emissionType;

        return $this;
    }
}
