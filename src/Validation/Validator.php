<?php

namespace PabloVeintimilla\FacturaEC\Validation;

use Symfony\Component\Validator\Validation;

/**
 * Validator base with common operations.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
Trait Validator
{

    /**
     * Check if object is valid
     * 
     * @return bool
     */
    public function isValid(): bool
    {
        /**
         * @var Symfony\Component\Validator\ConstraintViolation[]
         */
        $errors = $this->validate();
        if (!$errors->count()) {
            return true;
        }
        return false;
    }

    /**
     * Validate a object
     * @param object $object
     * @return \Symfony\Component\Validator\ConstraintValidator[]
     */
    public function validate($object)
    {
        $validator = $this->initValidation();
        return $validator->validate($object);
    }

    /**
     * Create validator and enable annotations
     *
     * @return Validation
     */
    private function initValidation()
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        return $validator;
    }
}