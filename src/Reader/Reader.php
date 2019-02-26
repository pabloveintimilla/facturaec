<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use PabloVeintimilla\FacturaEC\Model\Voucher;

/**
 * Reader from xml base with common operations.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Reader
{
    use Loader;
    /**
     * Full class of voucher to read.
     *
     * @var string;
     */
    private $voucherType = null;

    /**
     * @var Serializer;
     */
    private $serializer;

    /**
     * Xml data to read.
     *
     * @var string
     */
    private $xmlData = null;

    /**
     * @param string $voucherType Full name of class to read
     */
    public function __construct($voucherType = null)
    {
        //Check valid voucher type
        if ($voucherType) {
            $this->voucherType = is_subclass_of($voucherType, Voucher::class)
                ? $voucherType
                : null;
        }
        //TODO: Autodetect voucher type from xml
        //Instance serializer
        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(
            new IdenticalPropertyNamingStrategy()
        ));

        $this->serializer = $serializer->build();
    }

    public function getSerializer(): Serializer
    {
        return $this->serializer;
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
     * Load xml data as string.
     *
     * @param string $xmlData
     *
     * @return $this
     */
    public function load($xmlData)
    {
        $this->xmlData = $xmlData;

        return $this;
    }

    /**
     * Xml data of document.
     *
     * @return \DOMDocument
     */
    protected function getXmlData()
    {
        return $this->xmlData;
    }

    /**
     * Deserialize xml into a Voucher object.
     *
     * @return Voucher
     *
     * @throws \InvalidArgumentException
     */
    public function deserialize()
    {
        if (!$this->xmlData) {
            throw new \InvalidArgumentException('Not xml data');
        }

        return $this->serializer
                ->deserialize($this->xmlData, $this->voucherType, 'xml');
    }
}
