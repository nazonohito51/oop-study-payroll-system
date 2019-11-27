<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\Money;

use PayrollSystem\Domain\Exceptions\InvalidArgumentException;

class Rate
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException();
        }

        $this->value = $value;
    }
}
