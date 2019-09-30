<?php
declare(strict_types=1);

namespace Tests\Feature\UseCases;

use SalarySystem\Application\UseCases\AddEmployee;
use SalarySystem\Domain\Repositories\EmployeeRepositoryInterface;
use Tests\BaseTestCase;

class AddEmployeeTest extends BaseTestCase
{
    public function testAddHourlyEmployee()
    {
        // Arrange
        $expectedEmployee = new Employee('employeeId', 'name', 'address', 1000);
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('add')
            ->with($expectedEmployee)
            ->willReturn(true);
        $sut = new AddEmployee($repository);

        // Act
        $ret = $sut->addHourlyEmployee('employeeId', 'name', 'address', 1000);

        // Assert
        $this->assertTrue($ret);
    }

    public function testAddSalaryEmployee()
    {
        // Arrange
        $expectedEmployee = new Employee('employeeId', 'name', 'address', 1000);
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('add')
            ->with($expectedEmployee)
            ->willReturn(true);
        $sut = new AddEmployee($repository);

        // Act
        $ret = $sut->addSalaryEmployee('employeeId', 'name', 'address', 1000);

        // Assert
        $this->assertTrue($ret);
    }
}
