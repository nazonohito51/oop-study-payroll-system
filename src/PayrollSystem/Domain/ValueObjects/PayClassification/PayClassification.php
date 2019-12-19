<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification;

use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Money\Rate;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification\PayDaySpecificationInterface;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

interface PayClassification
{
    public function getPayDaySpecification(): PayDaySpecificationInterface;

    public function isPayDay(EmployeeId $employeeId, Date $date, PayRepositoryInterface $payRepository): bool;

    public function getRate(): Rate;

    public function calculatePay(Employee $employee, TimeCardRepositoryInterface $timeCardRepository): int;
}
