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
     * @var string
     */
    const FACTURA = '01';
    /**
     * @var string
     */
    const NOTA_CREDITO = '04';
    /**
     * @var string
     */
    const NOTA_DEBITO = '05';
    /**
     * @var string
     */
    const GUIA_REMISION = '07';
    /**
     * @var string
     */
    const COMPROBANTE_RETENCION = '07';
}
