<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use PabloVeintimilla\FacturaEC\Model\Base\IVoucher;

/**
 * Reader base with common operations.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Reader implements IReader
{
    /**
     * Full class name of voucher type to read.
     *
     * @var string;
     */
    protected $voucherType = null;

    /**
     * Data to read.
     *
     * @var string
     */
    protected $data;

    /**
     * @param string $data        Data of voucher to read
     * @param string $voucherType Full name of class to read
     */
    public function __construct($data, $voucherType)
    {
        //Check valid voucher type
        if (!is_subclass_of($voucherType, IVoucher::class)) {
            throw new ReaderException("Invalid voucher type: '$voucherType'");
        }
        $this->data = $data;
        $this->voucherType = $voucherType;
    }
}
