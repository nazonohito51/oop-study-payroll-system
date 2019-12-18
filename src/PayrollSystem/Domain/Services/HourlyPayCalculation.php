<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Services;

use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;

class HourlyPayCalculation implements PayCalculationInterface
{
    public function calculateAsInt(Employee $employee, TimeCardRepositoryInterface $timeCardRepository): int
    {
        $timeCards = $timeCardRepository->findByEmployeeId($employee->id());
        $total = 0;
        $hourlyRate = $employee->getPayClassification()->getRate();
        foreach ($timeCards as $timeCard) {
            $total += $hourlyRate->calcAsInt($timeCard->getHour()->getAsInt());
        }
        $total += 3000;
        return $total;
    }
}
