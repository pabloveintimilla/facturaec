<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use PabloVeintimilla\FacturaEC\Model\Voucher;

/**
 * Reader from xml base with common operations.
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
     * @param string $data        Xml data to read
     * @param string $voucherType Full name of class to read
     */
    public function __construct($data, $voucherType)
    {
        //Check valid voucher type
        if (!is_subclass_of($voucherType, Voucher::class)) {
            throw new Exception('Invalid voucher type');
        }
        $this->data = $data;
        $this->voucherType = $voucherType;
    }
}
