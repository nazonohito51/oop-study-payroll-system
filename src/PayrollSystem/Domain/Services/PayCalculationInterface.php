<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Services;

use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;

interface PayCalculationInterface
{
    public function calculateAsInt(Employee $employee, TimeCardRepositoryInterface $timeCardRepository): int;
}
