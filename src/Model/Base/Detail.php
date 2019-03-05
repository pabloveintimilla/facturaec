<?php

namespace PabloVeintimilla\FacturaEC\Model\Base;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Generic detail of voucher (Detalle de comprobante electrónico).
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("detalle")
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Detail implements IDetail
{
}
