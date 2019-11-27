<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Factories;

use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\ValueObjects\Address;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Name;
use PayrollSystem\Domain\ValueObjects\PayClassification\CommissionedClassification;
use PayrollSystem\Domain\ValueObjects\PayClassification\HourlyClassification;
use PayrollSystem\Domain\ValueObjects\PayClassification\SalariedClassification;

class EmployeeFactory
{
    public function createHourlyEmployee(string $id, string $name, string $address, int $hourlyRate): Employee
    {
        $employeeId = new EmployeeId($id);
        $employeeName = new Name($name);
        $employeeAddress = new Address($address);
        $hourlyClassification = new HourlyClassification($hourlyRate);

        return new Employee($employeeId, $employeeName, $employeeAddress, $hourlyClassification);
    }

    public function createSalaryEmployee(string $id, string $name, string $address, int $monthlySalary): Employee
    {
        $employeeId = new EmployeeId($id);
        $employeeName = new Name($name);
        $employeeAddress = new Address($address);
        $salaryClassification = new SalariedClassification($monthlySalary);

        return new Employee($employeeId, $employeeName, $employeeAddress, $salaryClassification);
    }

    public function createCommissionedEmployee(string $id, string $name, string $address, int $salaryRate, int $commissionedRate): Employee
    {
        $employeeId = new EmployeeId($id);
        $employeeName = new Name($name);
        $employeeAddress = new Address($address);
        $commissionedClassification = new CommissionedClassification($salaryRate, $commissionedRate);

        return new Employee($employeeId, $employeeName, $employeeAddress, $commissionedClassification);
    }
}
