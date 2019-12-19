<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification;

use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\Exceptions\InvalidArgumentException;
use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;
use PayrollSystem\Domain\Services\HourlyPayCalculation;
use PayrollSystem\Domain\Services\PayCalculationInterface;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Money\Rate;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification\PayDaySpecificationInterface;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

class HourlyClassification implements PayClassification
{
    private Rate $hourlyRate;

    public function __construct(Rate $hourlyRate)
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

    public function isPayDay(EmployeeId $employeeId, Date $date, PayRepositoryInterface $payRepository): bool
    {
        return $this->getPayDaySpecification()->isSatisfiedBy($employeeId, $payRepository, $date);
    }

    public function getRate(): Rate
    {
        return $this->hourlyRate;
    }

    public function calculatePay(Employee $employee, TimeCardRepositoryInterface $timeCardRepository): int
    {
        return (new HourlyPayCalculation())->calculateAsInt($employee, $timeCardRepository);
    }
}
