<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification;

use PayrollSystem\Domain\Exceptions\InvalidArgumentException;
use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayClassification;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification\PayDaySpecificationInterface;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

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

    public function getPayDaySpecification(): PayDaySpecificationInterface
    {
        return new class implements PayDaySpecificationInterface {
            public function isSatisfiedBy(EmployeeId $id, PayRepositoryInterface $payRepository, Date $date): bool
            {
                return $date->isEndOfMonth();
            }
        };
    }

    public function getRate(): int
    {
        return $this->salaryRate;
    }
}
