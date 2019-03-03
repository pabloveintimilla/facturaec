<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use PabloVeintimilla\FacturaEC\Model\Voucher;

/**
 * Define generic operations to process read.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
interface IReader
{
    /**
     * @param string $data        Data to read
     * @param string $voucherType Full name of class to read
     */
    public function __construct($data, $voucherType);

    /**
     * Read data as voucher object.
     *
     * @return Voucher Voucher object read
     *
     * @throws \PabloVeintimilla\FacturaEC\Writer\Exception
     */
    public function read(): Voucher;
}
