<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use Symfony\Component\DomCrawler\Crawler;

/**
 * Adapt xml schema from SRI to objects.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Adapter
{
    use Loader;
    /**
     * @var string
     */
    private $xmlData = null;

    /**
     * @var Crawler
     */
    private $crawler;

    public function __construct($xmlData = null)
    {
        if ($xmlData) {
            $this->xmlData = $xmlData;
        }
    }

    /**
     * @param string $fileName
     *
     * @return $this
     */
    public function loadFromFile($fileName)
    {
        $this->xmlData = $this->loadXMLFromFile($fileName);

        return $this;
    }

    /**
     * Transform from xml from SRI To FacturaEC.
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function tranformIn()
    {
        if (!$this->xmlData) {
            throw new \InvalidArgumentException('Not xml data');
        }

        //Load sign voucher
        $xml = new \DOMDocument();
        $xml->loadXML($this->xmlData);
        $voucher = $xml->getElementsByTagName('comprobante');

        foreach ($voucher as $item) {
            foreach ($item->childNodes as $child) {
                if (XML_CDATA_SECTION_NODE == $child->nodeType) {
                    $item = $child->textContent;
                }
            }
        }

        // Load voucher
        $xml = new \DOMDocument();
        $xml->loadXML($item);

        // Load XSL file
        $xsl = new \DOMDocument();
        $xsl->load(dirname(dirname(__DIR__))
            .DIRECTORY_SEPARATOR.'resources'
            .DIRECTORY_SEPARATOR.'schemas'
            .DIRECTORY_SEPARATOR.'xsl'
            .DIRECTORY_SEPARATOR.'factura.xsl');

        // Configure the transformer and attach the xsl rules
        $processor = new \XSLTProcessor();
        $processor->importStyleSheet($xsl);

        return $processor->transformToXML($xml);
    }
}
