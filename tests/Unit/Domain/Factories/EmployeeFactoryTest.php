<?php
declare(strict_types=1);

namespace Tests\Unit\Domain\Factories;

use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\Factories\EmployeeFactory;
use PayrollSystem\Domain\ValueObjects\Address;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Name;
use PayrollSystem\Domain\ValueObjects\PayClassification\CommissionedClassification;
use PayrollSystem\Domain\ValueObjects\PayClassification\HourlyClassification;
use PayrollSystem\Domain\ValueObjects\PayClassification\SalariedClassification;
use Tests\BaseTestCase;

class EmployeeFactoryTest extends BaseTestCase
{
    public function testCreateHourlyEmployee()
    {
        // arrange
        $employeeId = new EmployeeId('5.002.0186');
        $employeeName = new Name('name');
        $employeeAddress = new Address('address');
        $hourlyClassification = new HourlyClassification(1000);
        $employee = new Employee($employeeId, $employeeName, $employeeAddress, $hourlyClassification);

        $sut = new EmployeeFactory();

        // act
        $actual = $sut->createHourlyEmployee('5.002.0186', 'name', 'address', 1000);

        // assert
        $this->assertEquals($employee, $actual);
    }

    public function testCreateSalaryEmployee()
    {
        // arrange
        $employeeId = new EmployeeId('5.002.0186');
        $employeeName = new Name('name');
        $employeeAddress = new Address('address');
        $salaryClassification = new SalariedClassification(1000);
        $employee = new Employee($employeeId, $employeeName, $employeeAddress, $salaryClassification);

        $sut = new EmployeeFactory();

        // act
        $actual = $sut->createSalaryEmployee('5.002.0186', 'name', 'address', 1000);

        // assert
        $this->assertEquals($employee, $actual);
    }

    public function testCreateCommissionedEmployee()
    {
        // arrange
        $employeeId = new EmployeeId('5.002.0186');
        $employeeName = new Name('name');
        $employeeAddress = new Address('address');
        $commissionedClassification = new CommissionedClassification(1000, 100);
        $employee = new Employee($employeeId, $employeeName, $employeeAddress, $commissionedClassification);

        $sut = new EmployeeFactory();

        // act
        $actual = $sut->createCommissionedEmployee('5.002.0186', 'name', 'address', 1000, 100);

        // assert
        $this->assertEquals($employee, $actual);
    }
}
