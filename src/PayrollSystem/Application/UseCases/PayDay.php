<?php
declare(strict_types=1);

namespace PayrollSystem\Application\UseCases;

use PayrollSystem\Domain\Entities\Pay;
use PayrollSystem\Domain\Repositories\EmployeeRepositoryInterface;
use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Money\Amount;
use PayrollSystem\Domain\ValueObjects\PayClassification\CommissionedClassification;
use PayrollSystem\Domain\ValueObjects\PayClassification\HourlyClassification;
use PayrollSystem\Domain\ValueObjects\PayClassification\SalariedClassification;
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
            if ($employee->getPayDaySpecification()->isSatisfiedBy($employee->id(), $this->payRepository, $date)) {
                if ($employee->getPayClassification() instanceof HourlyClassification) {
                    $timeCards = $this->timeCardRepository->findByEmployeeId($employee->id());
                    $total = 0;
                    $hourlyRate = $employee->getPayClassification()->getRate();
                    foreach ($timeCards as $timeCard) {
                        $total += $hourlyRate->calcAsInt($timeCard->getHour()->getAsInt());
                    }
                    $pay = new Pay($employee->id(), $date, new Amount($total));
                    $this->payRepository->add($pay);
                    $payDayEmployees[] = $employee;
                } elseif ($employee->getPayClassification() instanceof SalariedClassification) {
                    $pay = new Pay($employee->id(), $date, new Amount($employee->getPayClassification()->getRate()->getAsInt()));
                    $this->payRepository->add($pay);
                    $payDayEmployees[] = $employee;
                } elseif ($employee->getPayClassification() instanceof CommissionedClassification) {
                    $pay = new Pay($employee->id(), $date, new Amount($employee->getPayClassification()->getRate()->getAsInt()));
                    $this->payRepository->add($pay);
                    $payDayEmployees[] = $employee;
                }
            }
        }

        return count($payDayEmployees);
    }
}
