<?php

namespace PabloVeintimilla\FacturaEC\Reader;

use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use PabloVeintimilla\FacturaEC\Model\Voucher;

/**
 * Reader from xml base with common operations.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class XML extends Reader
{
    /**
     * @var Serializer;
     */
    private $serializer;

    /**
     * @param string $data        Xml data to read
     * @param string $voucherType Full name of class to read
     */
    public function __construct($data, $voucherType)
    {
        parent::__construct($data, $voucherType);

        //Instance serializer
        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(
            new IdenticalPropertyNamingStrategy()
        ));

        $this->serializer = $serializer->build();
    }

    /**
     * Deserialize xml into a Voucher object.
     *
     * @return Voucher
     */
    public function read(): Voucher
    {
        return $this->serializer
                ->deserialize($this->data, $this->voucherType, 'xml');
    }
}
