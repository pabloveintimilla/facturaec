<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Retention model (Comprobrante de retención).
 *
 * @JMSSerializer\ExclusionPolicy("all")
 * @JMSSerializer\XmlRoot("comprobanteRetencion")
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Retention extends Voucher
{
    /**
     * @var string
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\SerializedName("periodoFiscal")
     */
    private $period;
    /**
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("array<PabloVeintimilla\FacturaEC\Model\RetentionDetail>")
     * @JMSSerializer\SerializedName("impuestos")
     * @JMSSerializer\XmlList(entry = "impuesto")
     *
     * @var Detail[]
     */
    private $details = [];

    /**
     * Return detail object of voucher.
     *
     * @return Detail[]
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Replace all details of voucher type.
     *
     * @param Detail[] $details Array of detail
     *
     * @return $this.
     */
    public function setDetails(array $details)
    {
        foreach ($details as $detail) {
            try {
                $this->addDetail($detail);
            } catch (\Exception $exception) {
                continue;
            }
        }
        $this->details = $details;

        return $this;
    }

    /**
     * Add a detail of voucher type.
     *
     * @param Detail $detail Detail object
     *
     * @return $this.
     */
    public function addDetail(Detail $detail)
    {
        $this->details[] = $detail;

        return $this;
    }
}
