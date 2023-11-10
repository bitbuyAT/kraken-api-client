<?php

namespace bitbuyAT\Kraken\Objects;

class Balance
{
    /**
     * @var string
     */
    protected $currency;
    /**
     * @var float
     */
    protected $amount;

    public function __construct(string $currency, float $amount)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function amount(): float
    {
        return (float) number_format($this->amount, 4, '.', '');
    }
}
