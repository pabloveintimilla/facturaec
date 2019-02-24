<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Invoice model (Factura).
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Buyer
{
    /**
     * @var string Nombre Razón social comprador
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\SerializedName("razonSocialComprador")
     */
    private $company;
    /**
     * @var string Cedula, ruc, pasaporte comprador
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\SerializedName("identificacionComprador")
     */
    private $identification;

    /**
     * Get company "Nombre o razón social de comprador".
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Get company "RUC, Cedula o pasaporte de comprador".
     *
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * Set company "Nombre o razón social de comprador".
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
     * Set company "RUC, Cedula o pasaporte de comprador".
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
}
