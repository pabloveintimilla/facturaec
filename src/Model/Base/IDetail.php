<?php

namespace PabloVeintimilla\FacturaEC\Model\Base;

/**
 * Interface detail of voucher.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
interface IDetail
{
    /**
     * Force to implement __toString usefull to transform.
     *
     * @return string String representation of datail
     */
    public function __toString();

    public function __toXml();
}
