<?php

use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use PabloVeintimilla\FacturaEC\Reader\Tributaria;
use PabloVeintimilla\FacturaEC\Model\Factura;

$loader = require dirname(__DIR__) . '/vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$xml = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'schemas' . DIRECTORY_SEPARATOR . 'xml' . DIRECTORY_SEPARATOR . 'Factura_V_1_0_0.xml';

$comprobante = (new \PabloVeintimilla\FacturaEC\Reader\Factura())
    ->loadFromFile($xml);

var_dump($comprobante->read());

// Deserialize
$factura = new Factura();

$tributaria = new PabloVeintimilla\FacturaEC\Model\Tributaria();
$tributaria->setRazonSocial('hola')
    ->setNumeroComprobante('1001')
    ->setTipoEmision('01');

$detalle = new PabloVeintimilla\FacturaEC\Model\FacturaDetalle($factura);
$detalle->setDescripcion('Producto 1');


$factura->setTributaria($tributaria)
    ->setDetalles([$detalle]);


$serializer = $comprobante->getSerializer();
var_dump($serializer->serialize($factura, 'xml'));