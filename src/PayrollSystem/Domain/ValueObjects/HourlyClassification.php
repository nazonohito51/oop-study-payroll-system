<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects;

class HourlyClassification implements PayClassification
{
    private int $hourlyRate;

    public function __construct(int $hourlyRate)
    {
        $this->hourlyRate = $hourlyRate;
    }
}
