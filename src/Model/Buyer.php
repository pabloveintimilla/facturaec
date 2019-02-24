<?php

namespace PabloVeintimilla\FacturaEC\Model;

use JMS\Serializer\Annotation as JMSSerializer;

/**
 * Invoice model (Factura).
 *
 * @JMSSerializer\ExclusionPolicy("all")
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class Buyer
{
    /**
     * @var \DateTime Fecha de emisión format: dd/mm/yyyy
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("DateTime<'d/m/Y'>")
     * @JMSSerializer\SerializedName("fechaEmision")
     */
    private $date;

    /**
     * Get date of emission of voucher
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * Set date of emission of voucher
     * @return $this
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
        return $this;
    }
}