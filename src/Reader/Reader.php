<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;

/**
 * Reader base with common operations.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Reader
{
    /**
     * @var Serializer;
     */
    private $serializer;

    /**
     * Xml data to read.
     *
     * @var string
     */
    private $xmlData;

    public function __construct()
    {
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
        $this->xmlData = Loader::loadXMLFromFile($fileName);

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

    abstract public function read();
}
