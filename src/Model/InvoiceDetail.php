<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;
use PabloVeintimilla\FacturaEC\Model\Base\Detail;

/**
 * Invoice detail model.
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("detalle")
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class InvoiceDetail extends Detail
{
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("descripcion")
     */
    private $description;

    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("cantidad")
     *
     * @var float
     */
    private $quantity;

    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("precioUnitario")
     *
     * @var float
     */
    private $unitPrice;

    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("descuento")
     *
     * @var float
     */
    private $discount;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("precioTotalSinImpuesto")
     *
     * @var float
     */
    private $total;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codigoPrincipal")
     *
     * @var string
     */
    private $codeMain;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codigoAuxiliar")
     *
     * @var string
     */
    private $codeAuxiliary;

    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("array<PabloVeintimilla\FacturaEC\Model\Tax>")
     * @JMSSerializer\SerializedName("impuestos")
     * @JMSSerializer\XmlList(entry = "impuesto")
     * 
     * @var Tax[] Impuesto
     */
    private $taxes = [];

    /*
    * @override __toXml
    */
    public function __toXml()
    {
        $string = "";
        $string .= "<detalle>";
        $string .= "<codigoPrincipal>" . $this->codeMain . "</codigoPrincipal>";
        $string .= "<codigoAuxiliar>" . $this->codeMain . "</codigoAuxiliar>";
        $string .= "<descripcion>" . $this->description . "</descripcion>";
        $string .= "<cantidad>" . $this->quantity . "</cantidad>";
        $string .= "<precioUnitario>" . $this->unitPrice . "</precioUnitario>";
        $string .= "<descuento>" . $this->discount . "</descuento>";
        $string .= "<precioTotalSinImpuesto>" . ($this->total) . "</precioTotalSinImpuesto>";

        $string .= "<impuestos>";
        foreach ($this->taxes as $tax) {
            $string .= "<impuesto>";
            $string .= "<codigo>" . $tax->getCode() . "</codigo>";
            $string .= "<codigoPorcentaje>" . $tax->getPercentageCode() . "</codigoPorcentaje>";
            $string .= "<tarifa>" . $tax->getRate() . "</tarifa>";
            $string .= "<baseImponible>" . $tax->getBase() . "</baseImponible>";
            $string .= "<valor>" . $tax->getValue() . "</valor>";
            $string .= "</impuesto>";
        }
        $string .= "</impuestos>";

        $string .= "</detalle>";

        return $string;
    }

    //----------------------------------------
    /**
     * Add a tax of voucher.
     *
     * @param Tax $tax Tax object
     *
     * @return $this.
     */
    public function addTax(Tax $tax)
    {
        $this->taxes[] = $tax;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getCodeMain()
    {
        return $this->codeMain;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function setCodeMain($codeMain)
    {
        $this->codeMain = $codeMain;

        return $this;
    }

    public function __toString()
    {
        $string = "$this->description ($this->total)";

        return $string;
    }
}
