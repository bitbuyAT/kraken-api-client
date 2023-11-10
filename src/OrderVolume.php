<?php

namespace bitbuyAT\Kraken;

use bitbuyAT\Kraken\Exceptions\MinimalVolumeSizeNotFound;
use bitbuyAT\Kraken\Objects\Pair;

class OrderVolume
{
    /**
     * Check minimal volume size for selected pair.
     *
     * @throws MinimalVolumeSizeNotFound
     */
    public function checkMinimalSizeForPair(Pair $pair, float $volume): bool
    {
        return $this->getMinimalSizeForPair($pair) < $volume;
    }

    /**
     * Check minimal volume size for selected currency.
     *
     * @throws MinimalVolumeSizeNotFound
     */
    public function checkMinimalSize(string $currency, float $volume): bool
    {
        return $this->getMinimalSize($currency) < $volume;
    }

    /**
     * Get minimal volume size for selected pair.
     *
     * @throws MinimalVolumeSizeNotFound
     */
    public function getMinimalSizeForPair(Pair $pair)
    {
        return $this->getMinimalSize($pair->base());
    }

    /**
     * Get minimal volume size for selected currency.
     *
     * @throws MinimalVolumeSizeNotFound
     */
    public function getMinimalSize(string $currency)
    {
        $minimalSize = config('kraken.minimal_volumes.'.$currency);

        if (is_null($minimalSize)) {
            throw new MinimalVolumeSizeNotFound("Minimal volume size for currency [{$currency}] not found.");
        }

        return $minimalSize;
    }
}
