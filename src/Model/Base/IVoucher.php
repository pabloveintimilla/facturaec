<?php

namespace PabloVeintimilla\FacturaEC\Model\Base;

/**
 * Define generic operations of a voucher.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
interface IVoucher
{
    /**
     * Get identifier of voucher.
     *
     * @return string Unique identifier
     */
    public function getId();

    /**
     * Convert object to array.
     *
     * @return array Data object as array
     */
    public function toArray(): array;

    /**
     * Convert object to xml.
     *
     * @return string Data object as xml
     */
    public function toXml();
}
