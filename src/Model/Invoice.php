<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Invoice model (Factura).
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("factura")
 * 
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Invoice extends Voucher
{
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("array<PabloVeintimilla\FacturaEC\Model\InvoiceDetail>")
     * @JMSSerializer\SerializedName("detalles")
     * @JMSSerializer\XmlList(entry = "detalle")
     *
     * @var Detail[]
     */
    private $details = [];
    /**
     * @var float
     */
    private $subtotal;

    /**
     * Return detail object of voucher.
     *
     * @return Detail[]
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Replace all details of voucher type.
     *
     * @param Detail[] $details Array of detail
     *
     * @return $this.
     */
    public function setDetails(array $details)
    {
        foreach ($details as $detail) {
            try {
                $this->addDetail($detail);
            } catch (\Exception $exception) {
                continue;
            }
        }
        $this->details = $details;

        return $this;
    }

    /**
     * Add a detail of voucher type.
     *
     * @param Detail $detail Detail object
     *
     * @return $this.
     */
    public function addDetail(Detail $detail)
    {
        $this->details[] = $detail;

        return $this;
    }

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }
}
