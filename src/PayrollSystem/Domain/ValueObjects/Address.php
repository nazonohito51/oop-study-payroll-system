<?php declare(strict_types=1);


namespace PayrollSystem\Domain\ValueObjects;


use PayrollSystem\Domain\Exceptions\InvalidArgumentException;

final class Address
{
    private string $address;

    /**
     * Name constructor.
     * @param string $address
     */
    public function __construct(string $address)
    {
        if (strlen($address) == 0) {
            throw new InvalidArgumentException();
        }
        $this->address = $address;
    }
}
