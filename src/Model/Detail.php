<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Generic detail of voucher (Detalle de comprobante electrónico).
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("detalle")
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Detail
{
    /**
     * @var Voucher
     */
    private $voucher;

    /**
     * @param Voucher $voucher
     */
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    /**
     * Get voucher of this detail.
     *
     * @return \PabloVeintimilla\FacturaEC\Model\Voucher
     */
    public function getVoucher(): Voucher
    {
        return $this->voucher;
    }

    /**
     * Set voucher of this detail.
     *
     * @param \PabloVeintimilla\FacturaEC\Model\Voucher $voucher
     *
     * @return $this
     */
    public function setVoucher(Voucher $voucher)
    {
        $this->voucher = $voucher;

        return $this;
    }
}
