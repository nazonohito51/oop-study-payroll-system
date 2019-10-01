<?php
declare(strict_types=1);

namespace Tests\Feature\UseCases;

use PayrollSystem\Application\UseCases\AddEmployee;
use PayrollSystem\Domain\Repositories\EmployeeRepositoryInterface;
use Tests\BaseTestCase;
use PayrollSystem\Domain\Entities\Employee;

class AddEmployeeTest extends BaseTestCase
{
    public function testAddHourlyEmployee()
    {
        // Arrange
        $expectedEmployee = new Employee('5.002.0186', 'name', 'address', 1000);
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('add')
            ->with($expectedEmployee)
            ->willReturn(true);
        $sut = new AddEmployee($repository);

        // Act
        $ret = $sut->addHourlyEmployee('5.002.0186', 'name', 'address', 1000);

        // Assert
        $this->assertTrue($ret);
    }

    public function provideAddHourlyEmployeeWithInvalidArguments()
    {
        $validEmployeeId = '5.002.0186';
        $validName = 'ほげ 太郎';
        $validAddress = '東京都港区六本木1-2-3';
        $validSalariedClassification = 0;
        $validHourlyWage = 1000;

        return [
            'invalid employeeId 1' => ['', $validName, $validAddress, $validSalariedClassification, $validHourlyWage],
            'invalid employeeId 2' => ['11_char_str', $validName, $validAddress, $validSalariedClassification, $validHourlyWage],
            'invalid name' => [$validEmployeeId, '', $validAddress, $validSalariedClassification, $validHourlyWage],
            'invalid address' => [$validEmployeeId, $validName, '', $validSalariedClassification, $validHourlyWage],
            'invalid salariedClassification' => [$validEmployeeId, $validName, $validAddress, 11111, $validHourlyWage],
            'invalid hourlyWage' => [$validEmployeeId, $validName, $validAddress, $validSalariedClassification, -500],
        ];
    }

    /**
     * @param $employeeId
     * @param $name
     * @param $address
     * @param $salariedClassification
     * @param $hourlyWage
     * @dataProvider provideAddHourlyEmployeeWithInvalidArguments
     * @expectedException \PayrollSystem\Application\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage 入力されたパラメータに誤りがあります
     */
    public function testAddHourlyEmployeeWithInvalidArguments($employeeId, $name, $address, $salariedClassification, $hourlyWage)
    {
        // Arrange
        $expectedEmployee = new Employee($employeeId, $name, $address, $salariedClassification);
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('add')
            ->with($expectedEmployee)
            ->willReturn(true);
        $sut = new AddEmployee($repository);

        // Act
        $ret = $sut->addHourlyEmployee($employeeId, $name, $address, $hourlyWage);

        // Assert
        $this->assertTrue($ret);
    }

    public function testAddSalaryEmployee()
    {
        // Arrange
        $expectedEmployee = new Employee('5.002.0186', 'name', 'address', 1000);
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('add')
            ->with($expectedEmployee)
            ->willReturn(true);
        $sut = new AddEmployee($repository);

        // Act
        $ret = $sut->addSalaryEmployee('5.002.0186', 'name', 'address', 1000);

        // Assert
        $this->assertTrue($ret);
    }

    public function provideAddSalaryEmployeeWithInvalidArguments()
    {
        $validEmployeeId = '5.002.0186';
        $validName = 'ほげ 太郎';
        $validAddress = '東京都港区六本木1-2-3';
        $validSalariedClassification = 1;
        $validSalaryWage = 100000;

        return [
            'invalid employeeId 1' => ['', $validName, $validAddress, $validSalariedClassification, $validSalaryWage],
            'invalid employeeId 2' => ['11_char_str', $validName, $validAddress, $validSalariedClassification, $validSalaryWage],
            'invalid name' => [$validEmployeeId, '', $validAddress, $validSalariedClassification, $validSalaryWage],
            'invalid address' => [$validEmployeeId, $validName, '', $validSalariedClassification, $validSalaryWage],
            'invalid salariedClassification' => [$validEmployeeId, $validName, $validAddress, 11111, $validSalaryWage],
            'invalid hourlyWage' => [$validEmployeeId, $validName, $validAddress, $validSalariedClassification, -500],
        ];
    }

    /**
     * @param $employeeId
     * @param $name
     * @param $address
     * @param $salariedClassification
     * @param $salaryWage
     * @dataProvider provideAddHourlyEmployeeWithInvalidArguments
     * @expectedException \PayrollSystem\Application\Exceptions\InvalidArgumentException
     * @expectedExceptionMessage 入力されたパラメータに誤りがあります
     */
    public function testAddSalaryEmployeeWithInvalidArguments($employeeId, $name, $address, $salariedClassification, $salaryWage)
    {
        // Arrange
        $expectedEmployee = new Employee($employeeId, $name, $address, $salariedClassification);
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('add')
            ->with($expectedEmployee)
            ->willReturn(true);
        $sut = new AddEmployee($repository);

        // Act
        $ret = $sut->addSalaryEmployee($employeeId, $name, $address, $salaryWage);

        // Assert
        $this->assertTrue($ret);
    }
}
