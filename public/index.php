<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use PabloVeintimilla\FacturaEC\Model\Invoice;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

use PabloVeintimilla\FacturaEC\Model\InvoiceDetail;

$autoloader = require dirname(__DIR__).'/vendor/autoload.php';
AnnotationRegistry::registerLoader([$autoloader, 'loadClass']);

// init service container
$containerBuilder = new ContainerBuilder();

// init yaml file loader
$config = dirname(__DIR__).DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR;
$loader = new YamlFileLoader($containerBuilder, new FileLocator($config));
$loader->load('services.yml');

// Deserialize
$xml = dirname(__DIR__).
    DIRECTORY_SEPARATOR.'resources'.
    DIRECTORY_SEPARATOR.'schemas'.
    DIRECTORY_SEPARATOR.'xml'.
    DIRECTORY_SEPARATOR.'Factura_V_2_0_0.xml';

$comprobante = $containerBuilder->get('factura.reader')
    ->loadFromFile($xml);
dump($comprobante->read());

// Serialize
$invoice = new Invoice();

$header = new PabloVeintimilla\FacturaEC\Model\Header();
$header->setCompany('Pablo Veintimilla')
    ->setName('Clouder 7')
    ->setIdentification('1719415677')
    ->setAddress('Quito')
    ->setStore('001')
    ->setPoint('002')
    ->setSequential('0000000003')
    ->setVoucherType('01')
    ->setEnviromentType('1')
    ->setEmissionType('1');

$invoice->setHeader($header);

for ($i = 1; $i <= 3; $i++) {
    $detail = (new InvoiceDetail($invoice))
        ->setDescription("Producto $i")
        ->setQuantity($i)
        ->setUnitPrice($i * 10)
        ->setTotal(($i * 10) * $i);

    $invoice->addDetail($detail);
}

$serializer = $comprobante->getSerializer();
dump($serializer->serialize($invoice, 'xml'));
