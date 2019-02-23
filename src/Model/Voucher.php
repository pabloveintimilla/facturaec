<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Generic class of 'Comprobante electrónico'.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Voucher
{
    /**
     * @var Header información voucher
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("PabloVeintimilla\FacturaEC\Model\Header")
     * @JMSSerializer\SerializedName("infoTributaria")
     */
    private $header;

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
     * Return header object of voucher.
     *
     * @return Header
     */
    public function getHeader(): Header
    {
        return $this->header;
    }

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
     * Set header object of voucher.
     * 
     * @param Header $header
     * 
     * @return $this
     */
    public function setHeader(Header $header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Implements set detail of voucher type.
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
     * Implements set detail of voucher type.
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
}
