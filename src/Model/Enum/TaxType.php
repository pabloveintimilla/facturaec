<?php

namespace PabloVeintimilla\FacturaEC\Model\Enum;

use Elao\Enum\ReadableEnum;
use Elao\Enum\AutoDiscoveredValuesTrait;

/**
 * Tax type..
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class TaxType extends ReadableEnum
{
    use AutoDiscoveredValuesTrait;

    /**
     * Impuesto al valor agregado (IVA).
     *
     * @var string
     */
    const IVA = 2;
    /**
     * Impuesto a consumos especiales (ICE).
     *
     * @var string
     */
    const ICE = 3;
    /**
     * Impuesto Redimible a las Botellas Plásticas No Retornables (IRBPNR.
     * 
     * @var string
     */
    const IRBPNR = 5;

    public static function readables(): array
    {
        return [
            self::IVA => 'Impuesto al valor agregado (IVA)',
            self::ICE => 'Impuesto a consumos especiales (ICE)',
            self::IRBPNR => 'Impuesto Redimible a las Botellas Plásticas No Retornables (IRBPNR)',
        ];
    }

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
