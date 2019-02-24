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
     * @var Seller información voucher
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("PabloVeintimilla\FacturaEC\Model\Seller")
     * @JMSSerializer\SerializedName("infoTributaria")
     */
    private $seller;

    /**
     * @var Seller información voucher
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("PabloVeintimilla\FacturaEC\Model\Buyer")
     * @JMSSerializer\SerializedName("infoFactura")
     */
    private $buyer;

    /**
     * Get details of voucher.
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
     * Return seller object of voucher.
     *
     * @return Seller
     */
    public function getSeller(): Seller
    {
        return $this->seller;
    }

    /**
     * Set seller object of voucher.
     *
     * @param Seller $seller
     *
     * @return $this
     */
    public function setSeller(Seller $seller)
    {
        $this->seller = $seller;

        return $this;
    }
}
