<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects;

use PayrollSystem\Domain\Exceptions\InvalidArgumentException;

class SalariedClassification implements PayClassification
{
    private int $salaryRate;

    public function __construct(int $salaryRate)
    {
        if ($salaryRate <= 0) {
            throw new InvalidArgumentException();
        }
        $this->salaryRate = $salaryRate;
    }
}
