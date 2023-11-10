<?php

namespace bitbuyAT\Kraken\Contracts;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

interface Order extends Arrayable
{
    public const TYPE_BUY = 'buy';
    public const TYPE_SELL = 'sell';

    public const ORDER_TYPE_MARKET = 'market';
    public const ORDER_TYPE_LIMIT = 'limit'; // price = limit price
    public const ORDER_TYPE_STOP_LOSS = 'stop-loss'; // price = limit price
    public const ORDER_TYPE_TAKE_PROFIT = 'take-profit'; // price = take profit price
    public const ORDER_TYPE_STOP_LOSS_PROFIT = 'stop-loss-profit'; // price = stop loss price, price2 = take profit price
    public const ORDER_TYPE_STOP_LOSS_PROFIT_LIMIT = 'stop-loss-profit-limit'; // price = stop loss price, price2 = take profit price
    public const ORDER_TYPE_STOP_LOSS_LIMIT = 'stop-loss-limit'; // price = stop loss trigger price, price2 = triggered limit price
    public const ORDER_TYPE_TAKE_PROFIT_LIMIT = 'take-profit-limit'; // price = take profit trigger price, price2 = triggered limit price
    public const ORDER_TYPE_TRAILING_STOP = 'trailing-stop'; // price = trailing stop offset
    public const ORDER_TYPE_TRAILING_STOP_LIMIT = 'trailing-stop-limit'; // price = trailing stop offset, price2 = triggered limit offset
    public const ORDER_TYPE_STOP_LOSS_AND_LIMIT = 'stop-loss-and-limit'; // price = stop loss price, price2 = limit price
    public const ORDER_TYPE_SETTLE_POSITION = 'settle-position';

    public const FLAG_VIQC = 'viqc'; // volume in quote currency (not available for leveraged orders)
    public const FLAG_FCIB = 'fcib'; // prefer fee in base currency
    public const FLAG_FCIQ = 'fciq'; // prefer fee in quote currency
    public const FLAG_NOMPP = 'nompp'; // no market price protection
    public const FLAG_POST = 'post'; // post only order (available when ordertype = limit)

    /**
     * Set the price.
     */
    public function setPrice(float $price): void;

    /**
     * Set the second price.
     */
    public function setSecondPrice(float $secondPrice): void;

    public function setLeverage(string $leverage): void;

    public function setFlags(array $flags): void;

    public function setStartTime(Carbon $startTime): void;

    public function setExpireTime(Carbon $expireTime): void;

    public function setUserRef(string $userRef): void;
}
