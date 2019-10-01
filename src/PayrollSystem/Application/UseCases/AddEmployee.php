<?php
declare(strict_types=1);

namespace PayrollSystem\Application\UseCases;

use PayrollSystem\Domain\Repositories\EmployeeRepositoryInterface;

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
     * @param int $hourlyWage
     */
    public function addHourlyEmployee(string $employeeId, string $name, string $address, int $hourlyWage): void
    {

    }

    public function addSalaryEmployee(string $employeeId, string $name, string $address, int $monthlySalary): void
    {

    }
}
