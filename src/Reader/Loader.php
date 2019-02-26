<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Config\Util\Exception\XmlParsingException;
use Symfony\Component\Finder\Finder;

/**
 * Load resources to read.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
trait Loader
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
    public function loadXMLFromFile($fileName)
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
     * Load valid xml from a directory.
     *
     * @param string $diretory Full Path a directory to load xml
     *
     * @return string[] Array with valid xml contents
     *
     * @throws FileNotFoundException
     */
    public function loadXMLFromDirectory($diretory)
    {
        if (!is_dir($diretory)) {
            throw new FileNotFoundException(null, 0, null, $diretory);
        }

        $data = [];
        $finder = new Finder();
        $finder->path($diretory)->name('*.xml');

        foreach ($finder as $file) {
            $xml = $file->getContents();
            if ($this->isXMLValid($xml)) {
                $data[] = $xml;
            }
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
    public function isXMLValid($data)
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
