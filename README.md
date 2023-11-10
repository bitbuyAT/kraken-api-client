# Kraken.com exchange API, PHP 8 package.
Forked from and compatible with butschster/kraken-api-client v1.5 

## Installation
```composer require bitbuy-at/kraken-api-client```

## Using

### Laravel

#### Laravel
If you're using Laravel, the package will automatically register the Kraken provider and facade.


#### Configuration

You can update your .env file with the following:
```
KRAKEN_KEY=my_api_key
KRAKEN_SECRET=my_secret
KRAKEN_OTP=my_otp_key # if two-factor enabled, otherwise not required
```

#### Usage

By using facade
```php
use bitbuyAT\Kraken\Facade\Kraken;

$balances = Kraken::getAccountBalance(); 
// Will return bitbuyAT\Kraken\Objects\BalanceCollection

foreach($balances as $balance) {
    $currency = $balance->currency();
    $amount = $balance->amount();
}
```

By using dependency injection
```php
use bitbuyAT\Kraken\Contracts\Client;

class BalanceConstroller extends Controller {

    public function getBalance(Client $client)
    {
        $client->getAccountBalance();
        ...
    }
}
```

### Checking minimal volume size

See https://support.kraken.com/hc/en-us/articles/205893708-What-is-the-minimum-order-size-

#### Check minimal order size for pair
```php
$orderVolume = new \bitbuyAT\Kraken\OrderVolume;
$pair = $client->getAssetPairs('EOSETH')->first();
$isValidSize = $orderVolume->checkMinimalSizeForPair($pair, 1.1);
```

#### Check minimal order size for currency
```php
$orderVolume = new \bitbuyAT\Kraken\OrderVolume;
$isValidSize = $orderVolume->checkMinimalSizeForPair('EOS', 1.1);
```

#### Get minimal order size
```php
$orderVolume = new \bitbuyAT\Kraken\OrderVolume;

// Pair
$pair = $client->getAssetPairs('EOSETH')->first();
$minimalsize = $orderVolume->getMinimalSizeForPair($pair);

// Currency
$minimalsize = $orderVolume->getMinimalSize('EOS');
```


### API methods

#### Make request

```php
$client->request(string $method, array $parameters, bool $isPublic) : array;

// Public request
$trades = $client->request('Trades', ['pair' => 'BCHXBT']);

// Private request
$balance = $client->request('Balance', [], false);
```

**If request return an error, will be thrown an exception `bitbuyAT\Kraken\Exceptions\KrakenApiErrorException`**

#### Get tradable asset pairs
https://www.kraken.com/help/api#get-tradable-pairs

```php
$pairs = $client->getAssetPairs(string|array $pair, string $info='all') : bitbuyAT\Kraken\Objects\PairCollection;

foreach($pairs as $pair) {
    $pair->name();
}
```

#### Get ticker information
https://www.kraken.com/help/api#get-ticker-info

```php
$pairs = $client->getTicker(string|array $pair) : bitbuyAT\Kraken\Objects\TickerCollection;

foreach($pairs as $pair) {
    $pair->name();
    $pair->askPrice();
    $pair->askWholeLotVolume();
    $pair->askLotVolume();
    $pair->askLotVolume();
    ...
}
```

#### Get account balance
https://www.kraken.com/help/api#get-account-balance

```php
$balances = $client->getAccountBalance() : bitbuyAT\Kraken\Objects\BalanceCollection;

foreach($balances as $balance) {
    $currency = $balance->currency();
    $amount = $balance->amount();
}
```

#### Get open orders
https://www.kraken.com/help/api#get-open-orders

```php
$orders = $client->getOpenOrders(bool $trades = false) : bitbuyAT\Kraken\Objects\OrdersCollection;
```

#### Get closed orders
https://www.kraken.com/help/api#get-closed-orders

```php
$orders = $client->getClosedOrders(bool $trades = false, Carbon\Carbon $start = null, Carbon\Carbon $end = null) : bitbuyAT\Kraken\Objects\OrdersCollection;
```

#### Add new order
https://www.kraken.com/help/api#add-standard-order

```php
use bitbuyAT\Kraken\Contracts\Order as OrderContract;

$order = new bitbuyAT\Kraken\Order('BCHUSD', OrderContract::TYPE_BUY, OrderContract::ORDER_TYPE_MARKET, 20);

$orderStatus = $client->addOrder($order) : bitbuyAT\Kraken\Objects\OrderStatus;

$txid = $orderStatus->getTransactionId();
$desciption = $orderStatus->getDescription() = bitbuyAT\Kraken\Objects\OrderStatusDescription;
```

#### Cancel open order
https://www.kraken.com/help/api#cancel-open-order

```php
$client->cancelOrder(string $transactionId): array;
```

### Supported Methods
All currently supported methods with params explanation can be found in the client interface (`src/Contracts/Client.php`).

Do you need any further method, which is not listed here? Just open an issue with the required method or even better open a PR to speed things up!

# Contributing
Want to contribute? Great!

Create a new issue first, describing the feature or bug.

Just fork our code, make your changes, then let us know and we will review it.

1. Fork it.
2. Create a feature branch (git checkout -b my_feature)
3. Commit your changes (git commit -m "Added My Feature")
4. Push to the branch (git push origin my_feature)
5. Open a [Pull Request](https://github.com/bitbuyAT/kraken-api-client/compare)
6. Enjoy and wait ;)

We are constantly updating and improving our code. We hope it can be for the benefit of the entire community.

# License
MIT License

Please check [LICENSE.txt](https://github.com/bitbuyAT/kraken-api-client/blob/master/LICENSE.txt)

# Visit us

bitbuy GmbH / bitcoin.wien (https://www.bitcoin.wien/)