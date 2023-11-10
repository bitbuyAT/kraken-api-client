<?php

namespace bitbuyAT\Kraken\Contracts;

use bitbuyAT\Kraken\Exceptions\KrakenApiErrorException;
use bitbuyAT\Kraken\Objects\Balance;
use bitbuyAT\Kraken\Objects\BalanceCollection;
use bitbuyAT\Kraken\Objects\OrdersCollection;
use bitbuyAT\Kraken\Objects\OrderStatus;
use bitbuyAT\Kraken\Objects\Pair;
use bitbuyAT\Kraken\Objects\PairCollection;
use bitbuyAT\Kraken\Objects\Ticker;
use bitbuyAT\Kraken\Objects\TickerCollection;
use Carbon\Carbon;

interface Client
{
    /**
     * Get tradable asset pairs.
     *
     * @param string|array $pair
     * @param string       $info Info to retrieve
     *                           info = all info (default),
     *                           leverage = leverage info,
     *                           fees = fees schedule,
     *                           margin = margin info
     *
     * @return PairCollection|Pair[]
     *
     * @throws KrakenApiErrorException
     */
    public function getAssetPairs($pair = null, string $info = 'info'): PairCollection;

    /**
     * Get ticker information.
     *
     * @param string|array $pair comma delimited list of asset pairs to get info on
     *
     * @return TickerCollection|Ticker[]
     *
     * @throws KrakenApiErrorException
     */
    public function getTicker($pair): TickerCollection;

    /**
     * Make API call.
     *
     * @throws KrakenApiErrorException
     */
    public function request(string $method, array $parameters = [], bool $isPublic = true): array;

    /**
     * Get account balance.
     *
     * @return BalanceCollection|Balance[]
     *
     * @throws KrakenApiErrorException
     */
    public function getAccountBalance(): BalanceCollection;

    /**
     * Get trade balance.
     *
     * @throws KrakenApiErrorException
     */
    public function getTradeBalance(): array;

    /**
     * Add standard order.
     *
     * @throws KrakenApiErrorException
     */
    public function addOrder(Order $order): OrderStatus;

    /**
     * Cancel open order.
     *
     * @throws KrakenApiErrorException
     */
    public function cancelOrder(string $transactionId): array;

    /**
     * Get open orders.
     *
     * @param bool $trades Whether or not to include trades in output
     *
     * @throws KrakenApiErrorException
     */
    public function getOpenOrders(bool $trades = false): OrdersCollection;

    /**
     * Get closed orders.
     *
     * @param bool        $trades Whether or not to include trades in output
     * @param Carbon|null $start  Starting date
     * @param Carbon|null $end    Ending date
     *
     * @throws KrakenApiErrorException
     */
    public function getClosedOrders(bool $trades = false, Carbon $start = null, Carbon $end = null): OrdersCollection;
}
