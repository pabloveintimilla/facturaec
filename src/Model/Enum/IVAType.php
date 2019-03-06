<?php

namespace PabloVeintimilla\FacturaEC\Model\Enum;

use Elao\Enum\ReadableEnum;
use Elao\Enum\AutoDiscoveredValuesTrait;

/**
 * IVA type. (Tarifa del iva).
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class IVAType extends ReadableEnum
{
    use AutoDiscoveredValuesTrait;
    
    const IVA_0      = '0';
    const IVA_12     = '2';
    const IVA_14     = '3';
    const IVA_NONE   = '6';
    const IVA_EXEMPT = '7';

    public static function readables(): array
    {
        return [
            self::IVA_0 => 'IVA 0%',
            self::IVA_12 => 'IVA 12%',
            self::IVA_14 => 'IVA 14%',
            self::IVA_NONE => 'NO Objeto de IVA',
            self::IVA_EXEMPT => 'Exento de IVA',
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