<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;
use PabloVeintimilla\FacturaEC\Model\Base\Voucher;
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
class Invoice extends Voucher
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
     * @var Tax[]
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("array<PabloVeintimilla\FacturaEC\Model\Tax>")
     * @JMSSerializer\SerializedName("totalConImpuestos")
     * @JMSSerializer\XmlList(entry = "totalImpuesto")
     */
    private $taxes = [];

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

    //----------------------------------------
    private $PayMethods = [];
    //----------------------------------------


    public function otherXml()
    {
        $seller_id = $this->getBuyer()->getIdentification();
        $string = '';
        $string .= '<?xml version="1.0" encoding="UTF-8"?>';
        $string .= '<factura id="comprobante" version="1.0.0">';
        $string .= $this->otherinfoTributaria();
        $string .= '<infoFactura>';
        $string .= '<fechaEmision>' . $this->getdate()->format('d/m/Y') . '</fechaEmision>';
        // $string .= '<dirEstablecimiento>null</dirEstablecimiento>';
        $string .= $this->getSeller()->getSpecial() !== null ? '<contribuyenteEspecial>' . $this->getSeller()->getSpecial() . '</contribuyenteEspecial>' : '';
        $string .= '<obligadoContabilidad>' . $this->getSeller()->getAccounting() . '</obligadoContabilidad>';
        $string .= '<tipoIdentificacionComprador>' . (strlen($seller_id) === 13 ? '04' : '05') . '</tipoIdentificacionComprador>';
        $string .= '<razonSocialComprador>' . $this->getBuyer()->getCompany() . '</razonSocialComprador>';
        $string .= '<identificacionComprador>' . $seller_id . '</identificacionComprador>';
        $string .= '<totalSinImpuestos>' . $this->subtotal . '</totalSinImpuestos>';
        $string .= '<totalDescuento>' . $this->discount . '</totalDescuento>';
        $string .= '<totalConImpuestos>';
        foreach ($this->taxes as $tax) {
            $string .= "<impuesto>";
            $string .= "<codigo>" . $tax->getCode() . "</codigo>";
            $string .= "<codigoPorcentaje>" . $tax->getPercentageCode() . "</codigoPorcentaje>";
            $string .= "<baseImponible>" . $tax->getBase() . "</baseImponible>";
            $string .= "<tarifa>" . $tax->getRate() . "</tarifa>";
            $string .= "<valor>" . $tax->getValue() . "</valor>";
            $string .= "</impuesto>";
        }
        $string .= '</totalConImpuestos>';
        $string .= '<propina>' . ($this->tip == null ? 0 : $this->tip) . '</propina>';
        $string .= '<importeTotal>' . round($this->total, 2) . '</importeTotal>';
        $string .= '<moneda>' . $this->getCurrency() . '</moneda>';
        $string .= '</infoFactura>';
        $string .= '<pagos>';

        foreach ($this->PayMethods as $pay) {
            $string .= '<pago>';
            $string .= '<formaPago>' . $pay->getCode() . '</formaPago>';
            $string .= '<total>' . $pay->getValue() . '</total>';
            if ($pay->getTerm() && strlen($pay->getUnitTime())) {
                $string .= '<plazo>' . $pay->getTerm() . '</plazo>';
                $string .= '<unidadTiempo>' . $pay->getUnitTime() . '</unidadTiempo>';
            }
            $string .= '</pago>';
        }

        $string .= '</pagos>';
        $string .= '<detalles>';
        foreach ($this->getDetails() as $detail) {
            $string .= $detail->__toXml();
        }
        $string .= '</detalles>';
        $string .= '<infoAdicional>';
        $string .= '<campoAdicional nombre="Direccion">' . $this->getBuyer()->getAddress() . '</campoAdicional>';
        $string .= '</infoAdicional>';
        $string .= '</factura>';

        return $string;
    }

    public function addOrUpdateTax(Tax $tax)
    {
        $gruping = $this->grupingExist($tax);
        if ($gruping !== -1) {
            $aux = $this->taxes[$gruping];
            $aux->setBase($aux->getBase() + $tax->getBase());
            $aux->setValue($aux->getValue() + $tax->getValue());
        } else {
            $aux = new Tax();
            $aux->setCode($tax->getCode());
            $aux->setPercentageCode($tax->getPercentageCode());
            $aux->setRate($tax->getRate());
            $aux->setBase($tax->getBase());
            $aux->setValue($tax->getValue());
            $this->taxes[] = $aux;
        }

        return $this;
    }

    private function grupingExist($tax)
    {
        $result = -1;
        $i = 0;
        while ($i < count($this->taxes) && $result == -1) {
            if (
                $this->taxes[$i]->getCode() === $tax->getCode() &&
                $this->taxes[$i]->getPercentageCode() === $tax->getPercentageCode() &&
                $this->taxes[$i]->getRate() === $tax->getRate()
            ) {
                $result = $i;
            }
            $i++;
        }
        return $result;
    }

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
            $label = $base ? 'SUBTOTAL-' . IVAType::getLabel($iva) : IVAType::getLabel($iva);

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
     * Set descuento "Total descuento".
     *
     * @param float $discount
     *
     * @return $this
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
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
     * Set total "Total con impuestos".
     *
     * @param float $total
     *
     * @return $this
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTaxes(): array
    {
        return $this->taxes;
    }

    /**
     * Get the value of PayMethods
     */
    public function getPayMethods()
    {
        return $this->PayMethods;
    }

    /**
     * Set the value of PayMethods
     *
     * @return  self
     */

    public function setPayMethods($PayMethods)
    {
        $this->PayMethods = $PayMethods;

        return $this;
    }
}
