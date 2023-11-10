<?php

namespace bitbuyAT\Kraken\Objects;

class Pair
{
    /**
     * @var string
     */
    protected $pair;

    /**
     * @var array
     */
    protected $information;

    public function __construct(string $pair, array $information)
    {
        $this->pair = $pair;
        $this->information = $information;
    }

    /**
     * Pair name.
     */
    public function name(): string
    {
        return $this->pair;
    }

    /**
     * Alternate pair name.
     */
    public function altname(): string
    {
        return $this->information['altname'];
    }

    /**
     * Asset id of base component.
     */
    public function base(): string
    {
        return $this->information['base'];
    }

    /**
     * Asset id of quote component.
     */
    public function quote(): string
    {
        return $this->information['quote'];
    }

    /**
     * Volume lot size.
     */
    public function lot(): string
    {
        return $this->information['lot'];
    }
}
