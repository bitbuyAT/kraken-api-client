<?php

namespace bitbuyAT\Kraken\Tests;

use bitbuyAT\Kraken\Client;
use bitbuyAT\Kraken\Objects\Balance;
use bitbuyAT\Kraken\Objects\BalanceCollection;
use GuzzleHttp\Client as HttpClient;
use PHPUnit\Framework\TestCase;

class PrivateClientTest extends TestCase
{
    protected $krakenService;
    protected $ticker;
    protected $orderBook;
    protected $transactions;
    protected $assetPairs;

    protected function setUp(): void
    {
        parent::setUp();
        // instantiate service
        $this->krakenService = new Client(
            new HttpClient(),
            getenv('KRAKEN_KEY') ?? null,
            getenv('KRAKEN_SECRET') ?? null
        );
    }

    public function testClientInstanceCanBeCreated(): void
    {
        $this->assertInstanceOf(Client::class, $this->krakenService);
    }

    public function testGetAccountBalance(): void
    {
        $accountBalance = $this->krakenService->getAccountBalance();
        $this->assertInstanceOf(BalanceCollection::class, $accountBalance);

        $data = $accountBalance->toArray();
        $this->assertArrayHasKey('ZEUR', $data);

        $this->assertInstanceOf(Balance::class, $data['ZEUR']);
    }

    public function testGetBitcoinAddress(): void
    {
        $btcAddress = $this->krakenService->request(
            'DepositAddresses',
            ['asset' => 'BTC', 'method' => 'Bitcoin', 'new' => 'false'],
            false
        );

        $this->assertArrayHasKey(0, $btcAddress);
        $this->assertArrayHasKey('address', $btcAddress[0]);
    }
}
