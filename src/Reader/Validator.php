<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Validator base with common operations.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Validator
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }
}
