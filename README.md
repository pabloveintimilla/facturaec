[![Codacy Badge](https://api.codacy.com/project/badge/Grade/2fa8c0203a5b40e4b728c355b20de99e)](https://www.codacy.com/app/pabloveintimilla/facturaec?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=pabloveintimilla/facturaec&amp;utm_campaign=Badge_Grade)
[![Coding Standards](https://img.shields.io/badge/cs-PSR--2--R-yellow.svg)](https://github.com/php-fig-rectified/fig-rectified-standards)

# FacturaEC

> Project in development process.

## Introduction

> This is a PHP Library to handle electronic invoice of Ecuador (SRI), support: Invoices (facturas). Include operations to import from xml, read an transform (xml, json, cvs) data. This not implement user interface, this shoul be used as a library.

## Installation

> composer require pabloveintimilla/facturaec

## Use

### Bootstrap. 

This should be include to autoload classes

```php
<?php
use Doctrine\Common\Annotations\AnnotationRegistry;

$autoloader = require dirname(__DIR__).'/vendor/autoload.php';
AnnotationRegistry::registerLoader([$autoloader, 'loadClass']);
```

### Read a xml file

Get data from a xml file

```php
use PabloVeintimilla\FacturaEC\Model\Invoice;
use PabloVeintimilla\FacturaEC\Reader\XML;
use PabloVeintimilla\FacturaEC\Reader\Adapter;
use PabloVeintimilla\FacturaEC\Reader\Loader;

$invoice = (new Reader(Invoice::class))
    ->loadFromFile('PATH TO FILE')
    ->read();

// Get data
$invoice->getDate();
```

### Read miltiple files from directory

Automatic detect xml files from directory

```php
use PabloVeintimilla\FacturaEC\Model\Collection\VoucherCollection;

$loader = (new Loader())
    ->loadXMLFromDirectory('PATH TO DIRECTORY');

$invoices = new VoucherCollection();
foreach ($loader as $data){
    $adapter = new Adapter($data);
    $type = ucfirst(strtolower($adapter->getVoucherType()));
    $class = "PabloVeintimilla\FacturaEC\Model\\".$type;

    $invoice = (new XML($adapter->tranformIn(), $class))
        ->read();

    $invoices->add($invoice);
}
```

### Export

Export data to csv fie

```php
use PabloVeintimilla\FacturaEC\Writer\Csv;

$csv = new Csv($invoices);
$csv->write($directory. DIRECTORY_SEPARATOR . 'FILE NAME');
```

### Create a invoice object

Create object with fluent methods.

```php
use PabloVeintimilla\FacturaEC\Model\InvoiceDetail;
use PabloVeintimilla\FacturaEC\Model\Seller;

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
```