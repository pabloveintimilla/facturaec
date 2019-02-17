<?php

namespace PabloVeintimilla\FacturaEC\Model;

/**
 * Item of comprobante electrónico.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Detalle
{
    /**
     * @var Tributaria Comprobante reference
     */
    public $tributaria;

    /**
     * Comprobante object.
     *
     * @param \PabloVeintimilla\FacturaEC\Model\Tributaria $tributaria
     */
    public function __construct(Tributaria $tributaria)
    {
        $this->tributaria = $tributaria;
    }
}
