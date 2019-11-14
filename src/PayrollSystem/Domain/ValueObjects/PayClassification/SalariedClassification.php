<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification;

use PayrollSystem\Domain\Exceptions\InvalidArgumentException;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayClassification;

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
