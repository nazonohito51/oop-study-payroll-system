<?php
declare(strict_types=1);

namespace PayrollSystem\Application\UseCases;

use PayrollSystem\Domain\Repositories\EmployeeRepositoryInterface;

class AddEmployee
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param string $employeeId
     * @param string $name
     * @param string $address
     * @param int $hourlyRate
     * @return bool
     */
    public function addHourlyEmployee(string $employeeId, string $name, string $address, int $hourlyRate): bool
    {
        try {
            $employee = $this->employeeRepository->factory()->createHourlyEmployee($employeeId, $name, $address, $hourlyRate);
        } catch (\PayrollSystem\Domain\Exceptions\InvalidArgumentException $e) {
            throw new \PayrollSystem\Application\Exceptions\InvalidArgumentException('入力されたパラメータに誤りがあります');
        }

        $this->employeeRepository->add($employee);

        return true;
    }

    /**
     * @param string $employeeId
     * @param string $name
     * @param string $address
     * @param int $monthlySalary
     * @return bool
     */
    public function addSalaryEmployee(string $employeeId, string $name, string $address, int $monthlySalary): bool
    {
        try {
            $employee = $this->employeeRepository->factory()->createSalaryEmployee($employeeId, $name, $address, $monthlySalary);
        } catch (\PayrollSystem\Domain\Exceptions\InvalidArgumentException $e) {
            throw new \PayrollSystem\Application\Exceptions\InvalidArgumentException('入力されたパラメータに誤りがあります');
        }

        $this->employeeRepository->add($employee);

        return true;
    }

    public function addCommissionedEmployee(string $employeeId, string $name, string $address, int $salaryRate, int $commissionedRate)
    {
        try {
            $employee = $this->employeeRepository->factory()->createCommissionedEmployee($employeeId, $name, $address, $salaryRate, $commissionedRate);
        } catch (\PayrollSystem\Domain\Exceptions\InvalidArgumentException $e) {
            throw new \PayrollSystem\Application\Exceptions\InvalidArgumentException('入力されたパラメータに誤りがあります');
        }

        $this->employeeRepository->add($employee);

        return true;
    }
}
