<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use PabloVeintimilla\FacturaEC\Model\Factura;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$autoloader = require dirname(__DIR__) . '/vendor/autoload.php';
AnnotationRegistry::registerLoader([$autoloader, 'loadClass']);

// init service container
$containerBuilder = new ContainerBuilder();

// init yaml file loader
$config = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;
$loader = new YamlFileLoader($containerBuilder, new FileLocator($config));
$loader->load('services.yml');

// Deserialize
$xml = dirname(__DIR__) . 
    DIRECTORY_SEPARATOR . 'resources' .
    DIRECTORY_SEPARATOR . 'schemas' .
    DIRECTORY_SEPARATOR . 'xml' .
    DIRECTORY_SEPARATOR . 'Factura_V_2_0_0.xml';

$comprobante = $containerBuilder->get('factura.reader')
    ->loadFromFile($xml);

var_dump($comprobante->read());

// Serialize
$factura = new Factura();

$tributaria = new PabloVeintimilla\FacturaEC\Model\Tributaria();
$tributaria->setRazonSocial('hola')
    ->setNumeroComprobante('1001')
    ->setTipoEmision('1')
    ->setTipoComprobante('01');

$detalle = new PabloVeintimilla\FacturaEC\Model\FacturaDetalle($factura);
$detalle->setDescripcion('Producto 1');


$factura->setTributaria($tributaria)
    ->setDetalles([$detalle]);


$serializer = $comprobante->getSerializer();
var_dump($serializer->serialize($factura, 'xml'));