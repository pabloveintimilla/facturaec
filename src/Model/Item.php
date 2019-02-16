<?php

namespace PabloVeintimilla\FacturaEC\Model;


/**
 * Item of comprobante electrónico
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Item
{
    /**
     * @var Comprobante Comprobante reference
     */
    public $comprobante;

    /**
     * Comprobante object
     * @param \PabloVeintimilla\FacturaEC\Model\Comprobante $comprobante
     */
    public function __construct(Comprobante $comprobante)
    {
        $this->comprobante = $comprobante;
    }
}
