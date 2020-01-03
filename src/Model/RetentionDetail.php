<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;
use Elao\Enum\Bridge\Symfony\Validator\Constraint\Enum as AssertEnum;
use PabloVeintimilla\FacturaEC\Model\Base\Detail;

/**
 * Retention detail model.
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("impuesto")
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class RetentionDetail extends Detail
{
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codigo")
     */
    private $code;

    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codigoRetencion")
     *
     * @var float
     */
    private $codeRetention;

    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("baseImponible")
     *
     * @var float
     */
    private $base;

    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("porcentajeRetener")
     *
     * @var float
     */
    private $porcentage;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("float")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("valorRetenido")
     *
     * @var float
     */
    private $value;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codDocSustento")
     *
     * @AssertEnum(class="\PabloVeintimilla\FacturaEC\Model\Enum\VoucherType", asValue=true)
     *
     * @var string
     */
    private $voucherType;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("numDocSustento")
     *
     * @var string
     */
    private $voucherCode;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("DateTime<'d/m/Y'>")
     * @JMSSerializer\SerializedName("fechaEmisionDocSustento")
     *
     * @var string
     */
    private $date;
}
