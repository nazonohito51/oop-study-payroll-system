<?php
declare(strict_types=1);

namespace Tests\Feature\UseCases;

use PayrollSystem\Application\UseCases\AddEmployee;
use PayrollSystem\Domain\Repositories\EmployeeRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Address;
use PayrollSystem\Domain\ValueObjects\CommissionedClassification;
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
        $validSalaryWage = 100000;

        return [
            'invalid employeeId 1' => ['', $validName, $validAddress, $validSalaryWage],
            'invalid employeeId 2' => ['11_char_str', $validName, $validAddress, $validSalaryWage],
            'invalid name' => [$validEmployeeId, '', $validAddress, $validSalaryWage],
            'invalid address' => [$validEmployeeId, $validName, '', $validSalaryWage],
            'invalid salaryRate' => [$validEmployeeId, $validName, $validAddress, -500],
        ];
    }

    /**
     * @param $employeeId
     * @param $name
     * @param $address
     * @param $salaryRate
     * @dataProvider provideAddSalaryEmployeeWithInvalidArguments
     */
    public function testAddSalaryEmployeeWithInvalidArguments($employeeId, $name, $address, $salaryRate)
    {
        // Arrange
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $sut = new AddEmployee($repository);

        // Assertion
        $this->expectException('\PayrollSystem\Application\Exceptions\InvalidArgumentException');
        $this->expectExceptionMessage('入力されたパラメータに誤りがあります');

        // Act
        $ret = $sut->addSalaryEmployee($employeeId, $name, $address, $salaryRate);

        // Assert
        $this->assertTrue($ret);
    }

    public function testAddCommissionedEmployee()
    {
        // Arrange
        $employeeId = new EmployeeId('5.002.0186');
        $employeeName = new Name('name');
        $employeeAddress = new Address('address');
        $salary = new CommissionedClassification(300000, 1000);
        $expectedEmployee = new Employee($employeeId, $employeeName, $employeeAddress, $salary);
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('add')
            ->with($expectedEmployee)
            ->willReturn(true);
        $sut = new AddEmployee($repository);

        // Act
        $ret = $sut->addCommissionedEmployee('5.002.0186', 'name', 'address', 300000, 1000);

        // Assert
        $this->assertTrue($ret);
    }

    public function provideAddCommissionedEmployeeWithInvalidArguments()
    {
        $validEmployeeId = '5.002.0186';
        $validName = 'ほげ 太郎';
        $validAddress = '東京都港区六本木1-2-3';
        $validSalaryRate = 300000;
        $validCommissionedRate = 1000;

        return [
            'invalid employeeId 1' => ['', $validName, $validAddress, $validSalaryRate, $validCommissionedRate],
            'invalid employeeId 2' => ['11_char_str', $validName, $validAddress, $validSalaryRate, $validCommissionedRate],
            'invalid name' => [$validEmployeeId, '', $validAddress, $validSalaryRate, $validCommissionedRate],
            'invalid address' => [$validEmployeeId, $validName, '', $validSalaryRate, $validCommissionedRate],
            'invalid salaryRate' => [$validEmployeeId, $validName, $validAddress, -500, $validCommissionedRate],
            'invalid commissionedRate' => [$validEmployeeId, $validName, $validAddress, -$validSalaryRate, -500],
        ];
    }

    /**
     * @param string $employeeId
     * @param string $name
     * @param string $address
     * @param int $salaryRate
     * @param int $commissionRate
     * @dataProvider provideAddCommissionedEmployeeWithInvalidArguments
     */
    public function testAddCommissionedEmployeeWithInvalidArguments(string $employeeId, string $name, string $address, int $salaryRate, int $commissionRate)
    {
        // Arrange
        $repository = $this->createMock(EmployeeRepositoryInterface::class);
        $sut = new AddEmployee($repository);

        // Assertion
        $this->expectException('\PayrollSystem\Application\Exceptions\InvalidArgumentException');
        $this->expectExceptionMessage('入力されたパラメータに誤りがあります');

        // Act
        $ret = $sut->addCommissionedEmployee($employeeId, $name, $address, $salaryRate, $commissionRate);

        // Assert
        $this->assertTrue($ret);
    }
}
