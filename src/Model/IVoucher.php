<?php

namespace PabloVeintimilla\FacturaEC\Model;

/**
 * Define generic operations of a voucher.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
interface IVoucher
{
    /**
     * Convert object to array.
     *
     * @return array Data object as array
     */
    public function toArray(): array;
}
