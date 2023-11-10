<?php

namespace bitbuyAT\Kraken\Facade;

use bitbuyAT\Kraken\Contracts\Client;
use Illuminate\Support\Facades\Facade;

class Kraken extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return Client::class;
    }
}
