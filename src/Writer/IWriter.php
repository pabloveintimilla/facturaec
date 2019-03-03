<?php

namespace PabloVeintimilla\FacturaEC\Writer;

use PabloVeintimilla\FacturaEC\Model\Voucher;

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
     * @param Voucher $voucher
     */
    public function __construct(Voucher $voucher);

    /**
     * Save Voucher to file.
     * 
     * @param string $filename Name of file to save
     *
     * @throws \PabloVeintimilla\FacturaEC\Writer\Exception
     */
    public function write($filename);
}
