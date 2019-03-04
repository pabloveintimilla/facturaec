<?php

namespace PabloVeintimilla\FacturaEC\Writer;

use PabloVeintimilla\FacturaEC\Model\Collection\VoucherCollection;

/**
 * Base writer.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Writer implements IWriter
{
    /**
     * @var \PabloVeintimilla\FacturaEC\Model\Collection\VoucherCollectionr;
     */
    private $voucherCollectionr;

    /**
     * {@inheritdoc}
     */
    public function __construct(VoucherCollection $voucherCollection)
    {
        $this->voucherCollectionr = $voucherCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function getVouchers(): VoucherCollection
    {
        return $this->voucherCollectionr;
    }
}
