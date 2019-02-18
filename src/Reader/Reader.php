<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * Xml data to read.
     *
     * @var string
     */
    private $xmlData;

    public function __construct(ValidatorInterface $validator)
    {
        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(
                new IdenticalPropertyNamingStrategy()
                ));

        $this->serializer = $serializer->build();
        $this->validator = $validator;
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

    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    abstract public function read();
}
