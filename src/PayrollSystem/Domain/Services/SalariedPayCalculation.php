<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Services;

use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;

class SalariedPayCalculation implements PayCalculationInterface
{
    public function calculateAsInt(Employee $employee, TimeCardRepositoryInterface $timeCardRepository): int
    {
        return $employee->getPayClassification()->getRate()->getAsInt();
    }
}
