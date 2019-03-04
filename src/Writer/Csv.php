<?php

namespace PabloVeintimilla\FacturaEC\Writer;

use PabloVeintimilla\FacturaEC\Model\Voucher;
use PabloVeintimilla\FacturaEC\Model\Collection\VoucherCollection;
use League\Csv\Writer as CsvWriter;

/**
 * Export voucher to csv.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Csv extends Writer
{
    /**
     * @var CsvWriter Writer object
     */
    protected $csvWriter;

    /**
     * {@inheritdoc}
     */
    public function __construct(VoucherCollection $voucherCollection)
    {
        parent::__construct($voucherCollection);
        $this->csvWriter = CsvWriter::createFromString('');
    }

    /**
     * {@inheritdoc}
     */
    public function write($filename)
    {
        foreach ($this->getVouchers() as $voucher) {
            $this->csvWriter->insertOne($voucher->toArray());
        }

        if (!file_put_contents($filename, $this->csvWriter->getContent())) {
            throw new WriterException('Can not write to file: '.$filename);
        }
    }
}
