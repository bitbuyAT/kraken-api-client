<?php

namespace bitbuyAT\Kraken\Objects;

class OrderStatus
{
    /**
     * @var string
     */
    protected $transactionId;

    /**
     * @var OrderStatusDescription
     */
    protected $description;

    public function __construct(string $transactionId, array $descriptions = [])
    {
        $this->transactionId = $transactionId;

        $this->description = new OrderStatusDescription(
            $descriptions['order'] ?? null,
            $descriptions['close'] ?? null
        );
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function getDescription(): OrderStatusDescription
    {
        return $this->description;
    }
}
