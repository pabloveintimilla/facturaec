<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;
use PabloVeintimilla\FacturaEC\Model\Base\Voucher;
use PabloVeintimilla\FacturaEC\Model\Base\ITaxable;
use PabloVeintimilla\FacturaEC\Model\Enum\IVAType;
use PabloVeintimilla\FacturaEC\Model\Enum\TaxType;

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

        //BUYER
        $data['IDENTIFICATION'] = $this->getSeller()->getIdentification();
        $data['NUMBER'] = $this->getId();
        $data['COMPANY'] = $this->getSeller()->getName();

        //Date
        $date = parent::getDate();
        $data['DATE'] = $date->format('Y-m-d');

        //Details
        $details = [];
        foreach ($this->details as $detail) {
            $details[] = (string) $detail;
        }
        $data['DETAILS'] = implode(' - ', $details);

        //Base
        $data += $this->getTaxValues(true);

        $data['subtotal'] = $this->subtotal;

        //Taxs
        $data += $this->getTaxValues();

        $data['total'] = $this->total;

        return $data;
    }

    /**
     * Get values of taxs.
     *
     * @param bool $base Return base (true) or value
     *
     * @return array
     */
    private function getTaxValues($base = false)
    {
        $data = [];
        foreach (IVAType::values() as $iva) {
            $value = 0;
            $label = $base ? 'SUBTOTAL-'.IVAType::getLabel($iva) : IVAType::getLabel($iva);

            //Get IVA of current code
            $filter = array_filter($this->tax, function ($tax) use ($iva) {
                return TaxType::IVA == $tax->getCode() && $tax->getPercentageCode() == $iva;
            });

            if (!empty($filter)) {
                $tax = reset($filter);
                $value = $base ? $tax->getBase() : $tax->getValue();
            }

            $data[$label] = $value;
        }

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
