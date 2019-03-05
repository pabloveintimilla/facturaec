<?php

namespace PabloVeintimilla\FacturaEC\Model\Base;

/**
 * Interface of voucher taxables.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
interface ITaxable
{
    /**
     * Get taxs of voucher.
     *
     * @return array Taxs of voucher
     */
    public function getTaxs(): array;
}
