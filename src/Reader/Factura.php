<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use PabloVeintimilla\FacturaEC\Model\Factura as FacturaModel;

/**
 * Read data from xml and deserialize to a object.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Factura extends Reader
{
    /**
     * @var FacturaModel
     */
    private $facturaModel;

    public function read()
    {
        $this->facturaModel = parent::getSerializer()
            ->deserialize(parent::getXmlData(), FacturaModel::class, 'xml');

        return $this->facturaModel;
    }
}
