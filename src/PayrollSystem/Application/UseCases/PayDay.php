<?php
declare(strict_types=1);

namespace PayrollSystem\Application\UseCases;

use PayrollSystem\Domain\Entities\Pay;
use PayrollSystem\Domain\Repositories\EmployeeRepositoryInterface;
use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Money\Amount;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

class PayDay
{
    private EmployeeRepositoryInterface $employeeRepository;
    private TimeCardRepositoryInterface $timeCardRepository;
    private PayRepositoryInterface $payRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        TimeCardRepositoryInterface $timeCardRepository,
        PayRepositoryInterface $payRepository
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->timeCardRepository = $timeCardRepository;
        $this->payRepository = $payRepository;
    }

    public function pay(string $dateString): int
    {
        $date = new Date($dateString);

        $employees = $this->employeeRepository->all();
        $payDayEmployees = [];
        foreach ($employees as $employee) {
            if ($employee->isPayDay($date, $this->payRepository)) {
                $total = $employee->calculatePay($this->timeCardRepository);
                $pay = new Pay($employee->id(), $date, new Amount($total));
                $this->payRepository->add($pay);
                $payDayEmployees[] = $employee;
            }
        }

        return count($payDayEmployees);
    }
}
