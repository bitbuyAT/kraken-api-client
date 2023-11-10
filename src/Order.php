<?php

namespace bitbuyAT\Kraken;

use bitbuyAT\Kraken\Contracts\Order as OrderContract;
use Carbon\Carbon;

class Order implements OrderContract
{
    /**
     * Type of order (buy/sell).
     *
     * @var string
     */
    protected $type;

    /**
     * Order type.
     *
     * @var string
     */
    protected $orderType;

    /**
     * Order volume in lots.
     *
     * @var float
     */
    protected $volume;

    /**
     * Asset pair.
     *
     * @var string
     */
    protected $pair;

    /**
     * Price (Optional. Dependent upon ordertype).
     *
     * @var float
     */
    protected $price;

    /**
     * Secondary price (Optional. Dependent upon ordertype).
     *
     * @var float
     */
    protected $secondPrice;

    /**
     * Amount of leverage desired (Optional).
     *
     * @var string
     */
    protected $leverage;

    /**
     * Comma delimited list of order flags (Optional).
     *
     * @var array
     */
    protected $flags = [];

    /**
     * Scheduled start time (Optional).
     *
     * @var Carbon
     */
    protected $startTime;

    /**
     * Expiration time (Optional).
     *
     * @var Carbon
     */
    protected $expireTime;

    /**
     * User reference id. 32-bit signed number. (Optional).
     *
     * @var string
     */
    protected $userRef;

    /**
     * @param string $pair      Asset pair
     * @param string $type      Type of order (buy/sell)
     * @param string $orderType Order type
     * @param float  $volume    Order volume in lots
     */
    public function __construct(string $pair, string $type, string $orderType, float $volume)
    {
        $this->pair = $pair;
        $this->type = $type;
        $this->orderType = $orderType;
        $this->volume = $volume;
    }

    /**
     * Set the price.
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * Set the second price.
     */
    public function setSecondPrice(float $secondPrice): void
    {
        $this->secondPrice = $secondPrice;
    }

    public function setLeverage(string $leverage): void
    {
        $this->leverage = $leverage;
    }

    public function setFlags(array $flags): void
    {
        $this->flags = $flags;
    }

    public function setStartTime(Carbon $startTime): void
    {
        $this->startTime = $startTime;
    }

    public function setExpireTime(Carbon $expireTime): void
    {
        $this->expireTime = $expireTime;
    }

    public function setUserRef(string $userRef): void
    {
        $this->userRef = $userRef;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $parameters = [
            'pair' => $this->pair,
            'type' => $this->type,
            'ordertype' => $this->orderType,
            'volume' => $this->volume,
        ];

        if ($this->price) {
            $parameters['price'] = $this->price;
        }

        if ($this->secondPrice) {
            $parameters['price2'] = $this->secondPrice;
        }

        if ($this->leverage) {
            $parameters['leverage'] = $this->leverage;
        }

        if (!empty($this->flags)) {
            $parameters['oflags'] = implode(',', $this->flags);
        }

        if ($this->startTime) {
            $parameters['starttm'] = $this->startTime->timestamp;
        }

        if ($this->expireTime) {
            $parameters['expiretm'] = $this->expireTime->timestamp;
        }

        if ($this->userRef) {
            $parameters['userref'] = $this->userRef;
        }

        return $parameters;
    }
}
