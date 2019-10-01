<?php
declare(strict_types=1);

namespace PayrollSystem\Application\UseCases;

use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\Exceptions\InvalidArgumentException;
use PayrollSystem\Domain\Repositories\EmployeeRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\EmployeeId;
use PayrollSystem\Domain\ValueObjects\HourlyClassification;

class AddEmployee
{
    private $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param string $employeeId
     * @param string $name
     * @param string $address
     * @param int $hourlyRate
     * @throws \PayrollSystem\Application\Exceptions\InvalidArgumentException
     */
    public function addHourlyEmployee(string $employeeId, string $name, string $address, int $hourlyRate): void
    {
        try {
            $notification = new Notification();

            try {
                $employeeId = new EmployeeId($employeeId);
            } catch (InvalidArgumentException $e) {
                $notification->addError('employeeId is invalid.');
            }

            if ($notification->isEmpty()) {
                $employee = new Employee($employeeId, $name, $address, new HourlyClassification($hourlyRate));
            }
        } catch (\PayrollSystem\Domain\Exceptions\InvalidArgumentException $e) {
            throw new \PayrollSystem\Application\Exceptions\InvalidArgumentException('入力されたパラメータに誤りがあります');
        }

        $this->employeeRepository->add($employee);
    }

    public function addSalaryEmployee(string $employeeId, string $name, string $address, int $monthlySalary): void
    {

    }
}
