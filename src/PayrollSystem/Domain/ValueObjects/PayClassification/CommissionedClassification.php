<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification;

use PayrollSystem\Domain\Exceptions\InvalidArgumentException;
use PayrollSystem\Domain\ValueObjects\Money\Rate;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification\CommissionedPayDaySpecification;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification\PayDaySpecificationInterface;

class CommissionedClassification extends SalariedClassification
{
    private Rate $commissionRate;

    public function __construct(Rate $salaryRate, Rate $commissionRate)
    {
        parent::__construct($salaryRate);

        if ($commissionRate <= 0) {
            throw new InvalidArgumentException();
        }
        $this->commissionRate = $commissionRate;
    }

    public function getPayDaySpecification(): PayDaySpecificationInterface
    {
        return new CommissionedPayDaySpecification();
    }

    public function getCommissionRate(): Rate
    {
        return $this->commissionRate;
    }
}
