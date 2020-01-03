<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use PabloVeintimilla\FacturaEC\Model\Invoice;
use PabloVeintimilla\FacturaEC\Model\InvoiceDetail;
use PabloVeintimilla\FacturaEC\Model\Seller;
use PabloVeintimilla\FacturaEC\Model\Buyer;

$autoloader = require dirname(__DIR__) . '/vendor/autoload.php';
AnnotationRegistry::registerLoader([$autoloader, 'loadClass']);

// Serialize
$invoice = (new Invoice())
    ->setStore('001')
    ->setPoint('002')
    ->setSequential('0000000003')
    ->setVoucherType('01')
    ->setEnviromentType('1')
    ->setDate(new \DateTime('01-01-2020'))
    ->setEmissionType('1');

$seller = (new Seller())
    ->setCompany('Pablo Veintimilla')
    ->setName('Clouder 7')
    ->setIdentification('1719415677')
    ->setAddress('Quito');
$invoice->setSeller($seller);

$buyer = (new Buyer())
    ->setCompany('Pablo Veintimilla')
    ->setIdentification('1719415677')
    ->setAddress('Quito');
$invoice->setBuyer($buyer);

for ($i = 1; $i <= 3; $i++) {
    $detail = (new InvoiceDetail($invoice))
        ->setDescription("Producto $i")
        ->setQuantity($i)
        ->setUnitPrice($i * 10)
        ->setTotal(($i * 10) * $i);

    $invoice->addDetail($detail);
}

var_dump($invoice->toArray());
var_dump($invoice->toXml());
