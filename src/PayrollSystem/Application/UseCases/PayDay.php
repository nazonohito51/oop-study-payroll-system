<?php
declare(strict_types=1);

namespace PayrollSystem\Application\UseCases;

use PayrollSystem\Domain\Repositories\EmployeeRepositoryInterface;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

class PayDay
{
    private EmployeeRepositoryInterface $employeeRepository;
    private TimeCardRepositoryInterface $timeCardRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        TimeCardRepositoryInterface $timeCardRepository
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->timeCardRepository = $timeCardRepository;
    }

    public function pay(string $dateString): int
    {
        $date = new Date($dateString);

        // TODO: search for employees whose payday is today.
        $employees = $this->employeeRepository->all();
        $payDayEmployees = $employees;

        foreach ($payDayEmployees as $payDayEmployee) {
            // TODO: pay
        }

        return count($payDayEmployees);
    }
}
