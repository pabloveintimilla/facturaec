<?php

namespace PabloVeintimilla\FacturaEC\Writer;

use PabloVeintimilla\FacturaEC\Model\Collection\VoucherCollection;

/**
 * Define generic operations to process write.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
interface IWriter
{
    /**
     * IWriter constructor.
     * 
     * @param VoucherCollection $voucherCollection Array of vouchers
     */
    public function __construct(VoucherCollection $voucherCollection);

    /**
     * Save Voucher to file.
     * 
     * @param string $filename Name of file to save
     *
     * @throws \PabloVeintimilla\FacturaEC\Writer\WriterException
     */
    public function write($filename);

    /**
     * Get vouchers of collection.
     *
     * @return VoucherCollection Array of voucher
     */
    public function getVouchers(): VoucherCollection;
}
