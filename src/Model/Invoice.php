<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;
use PabloVeintimilla\FacturaEC\Model\Base\Voucher;
use PabloVeintimilla\FacturaEC\Model\Base\ITaxable;

/**
 * Invoice model (Factura).
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("factura")
 * 
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Invoice extends Voucher implements ITaxable
{
    /**
     * @var float
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("float")
     * @JMSSerializer\SerializedName("propina")
     */
    private $tip;
    /**
     * @var float
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("float")
     * @JMSSerializer\SerializedName("totalDescuento")
     */
    private $discount;
    /**
     * @var float
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("float")
     * @JMSSerializer\SerializedName("totalSinImpuestos")
     */
    private $subtotal;
    /**
     * @var Tax{]
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("array<PabloVeintimilla\FacturaEC\Model\Tax>")
     * @JMSSerializer\SerializedName("totalConImpuestos")
     * @JMSSerializer\XmlList(entry = "totalImpuesto")
     */
    private $tax;
    /**
     * @var float
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("float")
     * @JMSSerializer\SerializedName("importeTotal")
     */
    private $total;

    /**
     * Overwrite details property of parent class to define serialization /
     * deserialization.
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("array<PabloVeintimilla\FacturaEC\Model\InvoiceDetail>")
     * @JMSSerializer\SerializedName("detalles")
     * @JMSSerializer\XmlList(entry = "detalle")
     *
     * @return Detail[]
     */
    protected $details;

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $data = [];
        $data['voucherType'] = parent::getVoucherType();

        $date = parent::getDate();
        $data['date'] = $date->format('Y-m-d H:i:s');

        return $data;
    }

    /**
     * Set subrotal "Total sin impuestos".
     *
     * @return float
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set subrotal "Total sin impuestos".
     *
     * @param float $subtotal
     *
     * @return $this
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxs(): array
    {
        return $this->tax;
    }
}
