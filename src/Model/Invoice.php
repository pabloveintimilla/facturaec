<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Invoice model (Factura).
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("factura")
 * 
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Invoice extends Voucher
{
}
