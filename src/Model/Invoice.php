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
     * @var Tax[]
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
     * @var InvoiceDetail[]
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("array<PabloVeintimilla\FacturaEC\Model\InvoiceDetail>")
     * @JMSSerializer\SerializedName("detalles")
     * @JMSSerializer\XmlList(entry = "detalle")
     *
     * @return InvoiceDetail[]
     */
    protected $invoiceDetail = [];

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
     * {@inheritdoc}
     */

    public function toXml()
    {
        $arrayTributaria = [
            'ambiente' => $this->getEnviromentType(), //Check
            'tipoEmision' => $this->getEmissionType(), //Check
            'razonSocial' => $this->getSeller()->getCompany(),
            'nombreComercial' => $this->getSeller()->getName(),
            'ruc' => $this->getSeller()->getIdentification(),
            'claveAcceso' => $this->getdate()->format('dmY') . '01' . $this->getSeller()->getIdentification() . '1' . $this->getStore() . $this->getPoint() . $this->getSequential(),
            'codDoc' => $this->getVoucherType(),
            'estab' => $this->getStore(),
            'ptoEmi' => $this->getPoint(),
            'secuencial' => $this->getSequential(),
            'dirMatriz' => $this->getSeller()->getAddress()
        ];

        $xml = new \DOMDocument('1.0', 'UTF-8');
        $rootNode = $xml->appendChild($xml->createElement("factura"));
        $id_attr = $xml->createAttribute('id');
        $id_attr->value = 'comprobante';
        $rootNode->appendChild($id_attr);
        $version_attr = $xml->createAttribute('version');
        $version_attr->value = '1.0.0';
        $rootNode->appendChild($version_attr);
        $infoTributaria = $rootNode->appendChild($xml->createElement("infoTributaria"));
        foreach ($arrayTributaria as $k => $v) {
            $infoTributaria->appendChild($xml->createElement($k, $v));
        }

        $arrayInfoFactura = [
            'fechaEmision' => $this->getdate()->format('d/m/Y'), //Check
            'dirEstablecimiento' => null, //Check
            'contribuyenteEspecial' => $this->getSeller()->getSpecial(),
            'obligadoContabilidad' => $this->getSeller()->getAccounting(),
            'tipoIdentificacionComprador' => $this->getBuyer()->getIdentification(), //UnCheck
            'razonSocialComprador' => $this->getBuyer()->getCompany(),
            'identificacionComprador' => $this->getBuyer()->getIdentification(),
            'direccionComprador' => $this->getBuyer()->getAddress(),
            'totalSinImpuestos' => $this->subtotal,
            'totalDescuento' => $this->discount == null ? 0 : $this->discount,
            //totalConImpuestos
            'propina' => $this->tip == null ? 0 : $this->tip,
            'importeTotal' => $this->total,
            'moneda' => $this->getCurrency(),
            //pagos
        ];

        $infoFactura = $rootNode->appendChild($xml->createElement("infoFactura"));
        foreach ($arrayInfoFactura as $k => $v) {
            $infoFactura->appendChild($xml->createElement($k, $v));
        }
        //totalConImpuestos
        $totalConImpuestos = $infoFactura->appendChild($xml->createElement("totalConImpuestos"));
        $totalImpuesto = $totalConImpuestos->appendChild($xml->createElement("totalImpuesto"));

        $totalImpuesto->appendChild($xml->createElement("codigo", 2));
        $totalImpuesto->appendChild($xml->createElement("codigoPorcentaje", 2));
        $totalImpuesto->appendChild($xml->createElement("baseImponible", $this->subtotal)); //UnCheck
        $totalImpuesto->appendChild($xml->createElement("valor", $this->subtotal * .12)); //UnCheck

        //pagos
        $pagos = $infoFactura->appendChild($xml->createElement("pagos"));
        $pago = $pagos->appendChild($xml->createElement("pago"));

        $pago->appendChild($xml->createElement("formaPago", 20));
        $pago->appendChild($xml->createElement("total", $this->total));
        $pago->appendChild($xml->createElement("plazo", 0));
        $pago->appendChild($xml->createElement("unidadTiempo", 'dias'));

        //Detalles
        $detalles = $rootNode->appendChild($xml->createElement("detalles"));

        foreach ($this->invoiceDetail as $v) {
            $detalle = $detalles->appendChild($xml->createElement("detalle"));
            $detalle->appendChild($xml->createElement('codigoPrincipal', $v->getCodeMain()));
            $detalle->appendChild($xml->createElement('codigoAuxiliar', $v->getCodeMain()));
            $detalle->appendChild($xml->createElement('descripcion', $v->getDescription()));
            $detalle->appendChild($xml->createElement('cantidad', $v->getQuantity()));
            $detalle->appendChild($xml->createElement('precioUnitario', $v->getUnitPrice()));
            $detalle->appendChild($xml->createElement('descuento', $v->getDiscount() == null ? 0 : $v->getDiscount()));
            $precioTotalSinImpuesto = $v->getUnitPrice() - $v->getDiscount();
            $detalle->appendChild($xml->createElement('precioTotalSinImpuesto', $precioTotalSinImpuesto));
            $impuestos = $detalle->appendChild($xml->createElement('impuestos'));
            $impuesto = $impuestos->appendChild($xml->createElement('impuesto'));
            $impuesto->appendChild($xml->createElement('codigo', 2));
            $impuesto->appendChild($xml->createElement('codigoPorcentaje', 2));
            $impuesto->appendChild($xml->createElement('tarifa', 12));
            $impuesto->appendChild($xml->createElement('baseImponible', $precioTotalSinImpuesto));
            $impuesto->appendChild($xml->createElement('valor', $precioTotalSinImpuesto * .12));
        }

        return $xml->saveXML();
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
