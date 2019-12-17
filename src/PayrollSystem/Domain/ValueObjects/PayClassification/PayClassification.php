<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification;

use PayrollSystem\Domain\ValueObjects\Money\Rate;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification\PayDaySpecificationInterface;

interface PayClassification
{
    public function getPayDaySpecification(): PayDaySpecificationInterface;

    public function getRate(): Rate;
}
