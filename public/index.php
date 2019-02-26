<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use PabloVeintimilla\FacturaEC\Model\Invoice;
use PabloVeintimilla\FacturaEC\Model\InvoiceDetail;
use PabloVeintimilla\FacturaEC\Model\Seller;
use PabloVeintimilla\FacturaEC\Model\Retention;
use PabloVeintimilla\FacturaEC\Reader\Reader;
use PabloVeintimilla\FacturaEC\Reader\Adapter;

$autoloader = require dirname(__DIR__).'/vendor/autoload.php';
AnnotationRegistry::registerLoader([$autoloader, 'loadClass']);

//Transform
// Deserialize invoice
$xml = dirname(__DIR__).
    DIRECTORY_SEPARATOR.'upload'.
    DIRECTORY_SEPARATOR.'Factura.xml';

$adapter = (new Adapter())
    ->loadFromFile($xml)
    ->tranformIn();

$invoice = (new Reader(Invoice::class))
    ->load($adapter)
    ->deserialize();

dump($invoice);

die;

// Deserialize invoice
$xml = dirname(__DIR__).
    DIRECTORY_SEPARATOR.'resources'.
    DIRECTORY_SEPARATOR.'schemas'.
    DIRECTORY_SEPARATOR.'xml'.
    DIRECTORY_SEPARATOR.'Factura.xml';


dump($invoice->isValid());

// Deserialize retention
$xml = dirname(__DIR__).
    DIRECTORY_SEPARATOR.'resources'.
    DIRECTORY_SEPARATOR.'schemas'.
    DIRECTORY_SEPARATOR.'xml'.
    DIRECTORY_SEPARATOR.'Retencion.xml';

$retention = (new Reader(Retention::class))
    ->loadFromFile($xml)
    ->deserialize();

dump($retention);
dump($retention->isValid());

// Serialize
$invoice = (new Invoice())
    ->setStore('001')
    ->setPoint('002')
    ->setSequential('0000000003')
    ->setVoucherType('01')
    ->setEnviromentType('1')
    ->setEmissionType('1');

$seller = (new Seller())
    ->setCompany('Pablo Veintimilla')
    ->setName('Clouder 7')
    ->setIdentification('1719415677')
    ->setAddress('Quito');
$invoice->setSeller($seller);

for ($i = 1; $i <= 3; $i++) {
    $detail = (new InvoiceDetail($invoice))
        ->setDescription("Producto $i")
        ->setQuantity($i)
        ->setUnitPrice($i * 10)
        ->setTotal(($i * 10) * $i);

    $invoice->addDetail($detail);
}

//$serializer = $comprobante->getSerializer();
// dump($serializer->serialize($invoice, 'xml'));
