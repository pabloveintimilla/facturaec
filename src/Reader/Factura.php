<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use PabloVeintimilla\FacturaEC\Model\Invoice as FacturaModel;
use Symfony\Component\Validator\Exception\ValidatorException;

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

        $validator = parent::getValidator();
        //TODO: validar todo el objeto, ahora esta quemado que valida solo tributación. Debe validar en casacada
        /** @var Symfony\Component\Validator\ConstraintViolation[] */
        $errors = $validator->validate($this->facturaModel->getSeller());
        if ($errors->count() > 0) {
            throw new ValidatorException((string) $errors);
        }

        return $this->facturaModel;
    }
}
