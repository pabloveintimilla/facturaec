<?php

namespace PabloVeintimilla\FacturaEC\Model\Base;

use JMS\Serializer\Annotation as JMSSerializer;
use Elao\Enum\Bridge\Symfony\Validator\Constraint\Enum as AssertEnum;
use PabloVeintimilla\FacturaEC\Model\Enum\VoucherType;
use PabloVeintimilla\FacturaEC\Model\Enum\EnviromentType;
use PabloVeintimilla\FacturaEC\Validation\Validator;
use PabloVeintimilla\FacturaEC\Model\Seller;
use PabloVeintimilla\FacturaEC\Model\Buyer;

/**
 * Base class of voucher 'Comprobante electrónico'.
 * 
 * @JMSSerializer\ExclusionPolicy("all")
 * 
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
abstract class Voucher implements IVoucher
{
    use Validator {
        validate as validateTrait;
    }
    /**
     * @var \DateTime Fecha de emisión format: dd/mm/yyyy
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("DateTime<'d/m/Y'>")
     * @JMSSerializer\SerializedName("fechaEmision")
     */
    private $date;

    /**
     * @var string Establecimiento
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("estab")
     */
    private $store;

    /**
     * @var string Punto de emisión
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("ptoEmi")
     */
    private $point;

    /**
     * @var string Número de comprobante
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("secuencial")
     */
    private $sequential;

    /**
     * @var VoucherType Tipo de comprobante.
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("codDoc")
     *
     * @AssertEnum(class="\PabloVeintimilla\FacturaEC\Model\Enum\VoucherType", asValue=true)
     */
    private $voucherType;

    /**
     * @var EnviromentType Desarrollo o produccion depende de en cual ambiente se genere el comprobante.
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("ambiente")
     *
     * @AssertEnum(class="\PabloVeintimilla\FacturaEC\Model\Enum\EnviromentType", asValue=true)
     */
    private $enviromentType;

    /**
     * @var string Tipo de emisión
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type ("string")
     * @JMSSerializer\XmlElement(cdata=false)
     * @JMSSerializer\SerializedName("tipoEmision")
     */
    private $emissionType = 1;

    /**
     * @var Seller información voucher
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("PabloVeintimilla\FacturaEC\Model\Seller")
     * @JMSSerializer\SerializedName("infoTributaria")
     */
    private $seller;

    /**
     * @var Buyer información voucher
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("PabloVeintimilla\FacturaEC\Model\Buyer")
     * @JMSSerializer\SerializedName("infoFactura")
     */
    private $buyer;

    /**
     * @var string
     *
     * @JMSSerializer\Expose
     * @JMSSerializer\Type("string")
     * @JMSSerializer\SerializedName("moneda")
     */
    private $currency = 'DOLAR';

    /**
     * @var Detail[]
     */
    protected $details = [];

    public function otherinfoTributaria()
    {
        $keyaccess = $this->date->format('dmY')
            . $this->voucherType . $this->seller->getIdentification()
            . '1' . $this->store . $this->point . $this->sequential
            . '123456781';

        $string = '';
        $string .= '<infoTributaria>';
        $string .= '<ambiente>' . $this->enviromentType . '</ambiente>';
        $string .= '<tipoEmision>' . $this->emissionType . '</tipoEmision>';
        $string .= '<razonSocial>' . $this->seller->getCompany() . '</razonSocial>';
        $string .= $this->seller->getName() === '' ? '<nombreComercial>' . $this->seller->getName() . '</nombreComercial>' : '';
        $string .= '<ruc>' . $this->seller->getIdentification() . '</ruc>';
        $string .= '<claveAcceso>' . $keyaccess . $this->generaDigitoModulo11($keyaccess) . '</claveAcceso>';
        $string .= '<codDoc>' . $this->voucherType . '</codDoc>';
        $string .= '<estab>' . $this->store . '</estab>';
        $string .= '<ptoEmi>' . $this->point . '</ptoEmi>';
        $string .= '<secuencial>' . $this->sequential . '</secuencial>';
        $string .= '<dirMatriz>' . $this->seller->getAddress() . '</dirMatriz>';
        $string .= '</infoTributaria>';

        return $string;
    }

    private function generaDigitoModulo11($cadena)
    {
        $cadena = trim($cadena);
        $baseMultiplicador = 7;
        $aux = new \SplFixedArray(strlen($cadena));
        $aux = $aux->toArray();
        $multiplicador = 2;
        $total = 0;
        $verificador = 0;
        for ($i = count($aux) - 1; $i >= 0; --$i) {
            $aux[$i] = substr($cadena, $i, 1);
            $aux[$i] *= $multiplicador;
            ++$multiplicador;
            if ($multiplicador > $baseMultiplicador) {
                $multiplicador = 2;
            }
            $total += $aux[$i];
        }
        if (($total == 0) || ($total == 1))
            $verificador = 0;
        else {
            $verificador = (11 - ($total % 11) == 11) ? 0 : 11 - ($total % 11);
        }
        if ($verificador == 10) {
            $verificador = 1;
        }
        return $verificador;
    }

    /**
     * Get date of emission of voucher.
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * Set date of emission of voucher.
     *
     * @return $this
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get store "Se detalla el numero del establecimiento".
     *
     * @return string
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * Get point "Se detalla el numero del punto de emision".
     *
     * @return string
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * Get sequential "Se detalla el secuencial del documento".
     *
     * @return string
     */
    public function getSequential()
    {
        return $this->sequential;
    }

    /**
     * Get voucher type "Tipo de comprobante".
     *
     * @return string VoucherType value
     */
    public function getVoucherType()
    {
        return $this->voucherType;
    }

    /**
     * Get enviromente type "Tipo de ambiente: Desarrollo o produccion depende
     * de en cual ambiente se genere el comprobante.".
     *
     * @return EnviromentType
     */
    public function getEnviromentType()
    {
        return $this->enviromentType;
    }

    /**
     * Get emission type "Tipo de emision en el cual se genero el comprobante".
     *
     * @return string
     */
    public function getEmissionType()
    {
        return $this->emissionType;
    }

    /**
     * Set store "Se detalla el numero del establecimiento".
     *
     * @param string $store
     *
     * @return $this
     */
    public function setStore($store)
    {
        $this->store = $store;

        return $this;
    }

    /**
     * Set point "Se detalla el numero del punto de emision".
     *
     * @param string $point
     *
     * @return $this
     */
    public function setPoint($point)
    {
        $this->point = $point;

        return $this;
    }

    /**
     * Set sequential "Se detalla el secuencial del documento".
     *
     * @param string $number
     *
     * @return $this
     */
    public function setSequential($number)
    {
        $this->sequential = $number;

        return $this;
    }

    /**
     * Set voucher type "Tipo de comprobante".
     *
     * @param VoucherType $voucherType Enum VoucherType
     *
     * @return $this
     *
     * @throws \UnexpectedValueException
     */
    public function setVoucherType($voucherType)
    {
        if (!VoucherType::accepts($voucherType)) {
            throw new \UnexpectedValueException("Invalid Voucher type value: $voucherType");
        }
        $this->voucherType = $voucherType;

        return $this;
    }

    /**
     * Set enviromente type "Tipo de ambiente: Desarrollo o produccion depende
     * de en cual ambiente se genere el comprobante.".
     *
     * @param EnviromentType $enviromentType
     *
     * @return $this
     */
    public function setEnviromentType($enviromentType)
    {
        if (!EnviromentType::accepts($enviromentType)) {
            throw new \UnexpectedValueException("Invalid enviroment type value: $enviromentType");
        }
        $this->enviromentType = $enviromentType;

        return $this;
    }

    /**
     * Set emission type "Tipo de emision en el cual se genero el comprobante".
     *
     * @param string $emissionType
     *
     * @return $this
     */
    public function setEmissionType($emissionType)
    {
        $this->emissionType = $emissionType;

        return $this;
    }

    /**
     * Return seller object of voucher.
     *
     * @return Seller
     */
    public function getSeller(): Seller
    {
        return $this->seller;
    }

    /**
     * Set seller object of voucher.
     *
     * @param Seller $seller
     *
     * @return $this
     */
    public function setSeller(Seller $seller)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * Get details of voucher.
     *
     * @return Detail[] Array of details
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
    public function addDetail($detail)
    {
        $this->details[] = $detail;

        return $this;
    }

    /**
     * Validate object.
     *
     * @return \Symfony\Component\Validator\ConstraintValidator[]
     */
    public function validate()
    {
        return $this->validateTrait($this);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        $id = "$this->store-$this->point-$this->sequential";

        return $id;
    }

    public function getBuyer(): Buyer
    {
        return $this->buyer;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setBuyer(Buyer $buyer)
    {
        $this->buyer = $buyer;

        return $this;
    }

    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }
}
