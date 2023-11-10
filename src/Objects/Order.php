<?php

namespace bitbuyAT\Kraken\Objects;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

class Order implements Arrayable
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var array
     */
    private $information;

    public function __construct(string $id, array $information)
    {
        $this->id = $id;
        $this->information = $information;
    }

    public function openDate(): Carbon
    {
        return Carbon::createFromTimestamp($this->information['opentm']);
    }

    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function status()
    {
        return $this->information['status'] ?? null;
    }

    public function volume(): float
    {
        return $this->information['vol'] ?? 0.0;
    }

    public function price(): float
    {
        return $this->information['price'] ?? 0.0;
    }

    public function cost(): float
    {
        return $this->information['cost'] ?? 0.0;
    }

    /**
     * Get the instance as an array.
     */
    public function toArray(): array
    {
        return array_merge(['txid' => $this->id], $this->information);
    }
}
