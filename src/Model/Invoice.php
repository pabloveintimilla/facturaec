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
    private $taxs;

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

        $details = [];
        foreach ($this->details as $detail) {
            $details[] = (string) $detail;
        }
        $data['details'] = implode(' - ', $details);

        $date             = parent::getDate();
        $data['date']     = $date->format('Y-m-d');

        //Base
        foreach (IVAType::values() as $key => $iva) {
            $label   = 'SUBTOTAL_'.IVAType::getLabel($iva);
            $value = 0;

            foreach ($this->taxs as $tax) {
                //If tax is IVA
                if ($tax->getCode() == TaxType::IVA) {
                    if ($tax->getPercentageCode() == $iva) {
                        $value = $tax->getBase();
                    }
                }
            }

            $data[$label] = $value;
        }

        $data['subtotal'] = $this->subtotal;

        //Taxs
        foreach (IVAType::values() as $key => $iva) {
            $label   = IVAType::getLabel($iva);
            $value = 0;

            foreach ($this->taxs as $tax) {
                //If tax is IVA
                if ($tax->getCode() == TaxType::IVA) {
                    if ($tax->getPercentageCode() == $iva) {
                        $value = $tax->getValue();
                    }
                }
            }

            $data[$label] = $value;
        }

        $data['total']    = $this->total;
        
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
        return $this->taxs;
    }
}