<?php

namespace PabloVeintimilla\FacturaEC\Model\Collection;

use PabloVeintimilla\FacturaEC\Model\Base\IVoucher;

/**
 * Collection of voucher.
 *
 * @author Pablo Veintimilla Vargas <pabloveintimilla@gmail.com>
 */
class VoucherCollection implements \Countable, \Iterator
{
    /**
     * @var IVoucher[]
     */
    private $vouchers = [];

    /**
     * @var int
     */
    private $currentIndex = 0;

    /**
     * Add a voucher.
     * 
     * @param IVoucher $voucher
     *
     * @return VoucherCollection
     */
    public function add(IVoucher $voucher)
    {
        $this->vouchers[] = $voucher;

        return $this;
    }

    /**
     * Remove a voucher.
     * 
     * @param IVoucher $voucher Voucher object to remove
     *
     * @return VoucherCollection
     */
    public function remove(IVoucher $voucher)
    {
        foreach ($this->vouchers as $key => $voucher) {
            if ($voucher->getSequential() === $voucher->getSequential()) {
                unset($this->vouchers[$key]);
            }
        }

        $this->vouchers = array_values($this->vouchers);

        return $this;
    }

    public function count(): int
    {
        return count($this->vouchers);
    }

    public function current(): IVoucher
    {
        return $this->vouchers[$this->currentIndex];
    }

    public function key(): \scalar
    {
        return $this->currentIndex;
    }

    public function next(): void
    {
        ++$this->currentIndex;
    }

    public function rewind(): void
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->vouchers[$this->currentIndex]);
    }
}
