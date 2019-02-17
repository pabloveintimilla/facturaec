<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Config\Util\Exception\XmlParsingException;

/**
 * Load resources to read.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Loader
{
    /**
     * Load xml data from a file.
     *
     * @param string $fileName
     *
     * @throws \Symfony\Component\Filesystem\Exception\FileNotFoundException
     *
     * @return string of document
     */
    public static function loadXMLFromFile($fileName)
    {
        if (!file_exists($fileName)) {
            throw new FileNotFoundException(null, 0, null, $fileName);
        }

        $data = file_get_contents($fileName);
        if (!self::isXMLValid($data)) {
            throw new XmlParsingException();
        }

        return $data;
    }

    /**
     * Check if data is a xml valid.
     *
     * @param string $data
     *
     * @return bool
     */
    public static function isXMLValid($data)
    {
        $xml = new \XMLReader();

        try {
            $xml->xml($data);
            $xml->setParserProperty(\XMLReader::VALIDATE, true);

            return $xml->isValid();
        } catch (Exception $ex) {
            return false;
        }
    }
}
