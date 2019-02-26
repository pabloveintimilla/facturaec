<?php

namespace PabloVeintimilla\FacturaEC\Model\Enum;

use Elao\Enum\Enum;
use Elao\Enum\AutoDiscoveredValuesTrait;

/**
 * Voucher type. (Tipos de comprobantes que pueden generar los contribuyentes).
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
final class VoucherType extends Enum
{
    use AutoDiscoveredValuesTrait;
    /**
     * Factura.
     *
     * @var string
     */
    const INVOICE = '01';
    /**
     * Nota de crédito.
     *
     * @var string
     */
    const CREDIT = '04';
    /**
     * Nota de débito.
     *
     * @var string
     */
    const DEBIT = '05';
    /**
     * Guía de remisión.
     *
     * @var string
     */
    const REMISSION = '07';
    /**
     * Comprobante de retensión.
     * 
     * @var string
     */
    const RETENTION = '07';

    /**
     * Get const name of a value.
     *
     * @param int $value
     *
     * @return string
     */
    public static function getLabel($value)
    {
        $class = new \ReflectionClass(__CLASS__);
        $constants = array_flip($class->getConstants());

        return $constants[$value];
    }
}
