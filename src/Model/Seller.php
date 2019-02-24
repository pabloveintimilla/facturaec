<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

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
}
