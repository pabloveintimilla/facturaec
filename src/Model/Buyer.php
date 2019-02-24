<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Invoice model (Factura).
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\VirtualProperty(
 *     "subtotal",
 *     exp="object.getVoucher().getSubtotal()",
 *     options={@JMSSerializer\SerializedName("totalSinImpuestos")}
 *  )
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Buyer
{
    /**
     * @var Voucher
     */
    private $voucher;
    /**
     * @var \DateTime Fecha de emisión format: dd/mm/yyyy
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("DateTime<'d/m/Y'>")
     * @JMSSerializer\SerializedName("fechaEmision")
     */
    private $date;
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
     * Get date of emission of voucher.
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * Set date of emission of voucher.
     *
     * @return $this
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

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

    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function getVoucher()
    {
        return $this->voucher;
    }

    public function setVoucher(Voucher $voucher)
    {
        $this->voucher = $voucher;

        return $this;
    }
}
