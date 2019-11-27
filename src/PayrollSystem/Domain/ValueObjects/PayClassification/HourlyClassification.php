<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification;


use PayrollSystem\Domain\Exceptions\InvalidArgumentException;
use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayClassification;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification\PayDaySpecificationInterface;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

class HourlyClassification implements PayClassification
{
    private int $hourlyRate;

    public function __construct(int $hourlyRate)
    {
        if ($hourlyRate <= 0) {
            throw new InvalidArgumentException();
        }
        $this->hourlyRate = $hourlyRate;
    }

    public function getPayDaySpecification(): PayDaySpecificationInterface
    {
        return new class implements PayDaySpecificationInterface {
            public function isSatisfiedBy(EmployeeId $id, PayRepositoryInterface $payRepository, Date $date): bool
            {
                return $date->isFriday();
            }
        };
    }

    public function getRate(): int
    {
        return $this->hourlyRate;
    }
}
