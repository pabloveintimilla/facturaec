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
     * @var Header información voucher
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("PabloVeintimilla\FacturaEC\Model\Buyer")
     * @JMSSerializer\SerializedName("infoFactura")
     */
    private $buyer;

    /**
     * Get details of voucher
     *
     * @return Detail[] Array of details
     */
    abstract public function getDetails();

    /**
     * Replace all details of voucher type.
     *
     * @param Detail[] $details Array of detail
     *
     * @return $this.
     */
    abstract public function setDetails(array $details);

    /**
     * Add a detail of voucher type.
     *
     * @param Detail $detail Detail object
     *
     * @return $this.
     */
    abstract public function addDetail(Detail $detail);

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
}