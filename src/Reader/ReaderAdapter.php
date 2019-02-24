<?php

namespace PabloVeintimilla\FacturaEC\Reader;

/**
 * Adapt xml schema from SRI to objects
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class ReaderAdapter
{
    private $xmlData;
    
    public function __construct($xmlData)
    {
        $this->xmlData = $xmlData;
    }
}