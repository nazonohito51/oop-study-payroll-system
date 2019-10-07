<?php
declare(strict_types=1);

namespace Tests\Feature\UseCases;

use PayrollSystem\Application\UseCases\AddEmployee;
use PayrollSystem\Domain\Repositories\EmployeeRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Address;
use PayrollSystem\Domain\ValueObjects\EmployeeId;
use PayrollSystem\Domain\ValueObjects\HourlyClassification;
use PayrollSystem\Domain\ValueObjects\Name;
use PayrollSystem\Domain\ValueObjects\SalariedClassification;
use Tests\BaseTestCase;
use PayrollSystem\Domain\Entities\Employee;

class AddEmployeeTest extends BaseTestCase
{
    public function testAddHourlyEmployee()
    {
        // Arrange
        $employeeId = new EmployeeId('5.002.0186');
        $employeeName = new Name('name');
        $employeeAddress = new Address('address');
        $expectedEmployee = new Employee($employeeId, $employeeName, $employeeAddress, new HourlyClassification(1000));
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
        $validHourlyWage = 1000;

        return [
            'invalid employeeId' => ['', $validName, $validAddress, $validHourlyWage],
            'invalid name' => [$validEmployeeId, '', $validAddress, $validHourlyWage],
            'invalid address' => [$validEmployeeId, $validName, '', $validHourlyWage],
            'invalid hourlyWage' => [$validEmployeeId, $validName, $validAddress, -500],
        ];
    }

    /**
     * @param $employeeId
     * @param $name
     * @param $address
     * @param $hourlyRate
     * @dataProvider provideAddHourlyEmployeeWithInvalidArguments
     */
    public function testAddHourlyEmployeeWithInvalidArguments($employeeId, $name, $address, $hourlyRate)
    {
        // Arrange
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $sut = new AddEmployee($repository);

        // Assert
        $this->expectException('\PayrollSystem\Application\Exceptions\InvalidArgumentException');
        $this->expectExceptionMessage('入力されたパラメータに誤りがあります');

        // Act
        $sut->addHourlyEmployee($employeeId, $name, $address, $hourlyRate);
    }

    public function testAddSalaryEmployee()
    {
        // Arrange
        $employeeId = new EmployeeId('5.002.0186');
        $employeeName = new Name('name');
        $employeeAddress = new Address('address');
        $salary = new SalariedClassification(1000);
        $expectedEmployee = new Employee($employeeId, $employeeName, $employeeAddress, $salary);
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
     * @param $salaryWage
     * @dataProvider provideAddHourlyEmployeeWithInvalidArguments
     */
    public function testAddSalaryEmployeeWithInvalidArguments($employeeId, $name, $address, $salaryWage)
    {
        // Arrange
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $sut = new AddEmployee($repository);

        // Assertion
        $this->expectException('\PayrollSystem\Application\Exceptions\InvalidArgumentException');
        $this->expectExceptionMessage('入力されたパラメータに誤りがあります');

        // Act
        $ret = $sut->addSalaryEmployee($employeeId, $name, $address, $salaryWage);

        // Assert
        $this->assertTrue($ret);
    }
}
