<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects;

class SalariedClassification implements PayClassification
{
    private int $salaryRate;

    public function __construct(int $salaryRate)
    {
        $this->salaryRate = $salaryRate;
    }
}
