<?php
declare(strict_types=1);

namespace Tests\Feature\UseCases;

use Carbon\CarbonImmutable;
use PayrollSystem\Application\UseCases\PayDay;
use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\Entities\Pay;
use PayrollSystem\Domain\Entities\TimeCard;
use PayrollSystem\Domain\Factories\EmployeeFactory;
use PayrollSystem\Domain\Repositories\EmployeeRepositoryInterface;
use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Money\Amount;
use PayrollSystem\Domain\ValueObjects\Time\Amount\Hour;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;
use Tests\BaseTestCase;

class PayDayTest extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        CarbonImmutable::setTestNow(CarbonImmutable::now());
    }

    protected function tearDown(): void
    {
        CarbonImmutable::setTestNow();

        parent::tearDown();
    }

    public function providePayDayToHourlyClassification()
    {
        $hourlyEmployee = (new EmployeeFactory())->createHourlyEmployee('5.002.0186', 'name', 'address', 1000);
        $employeeId = $hourlyEmployee->id();

        $timeCards = [
            new TimeCard(
                $employeeId,
                new Date(CarbonImmutable::createFromDate(2019, 11, 26)->toDateString()),
                new Hour(3)
            ),
            new TimeCard(
                $employeeId,
                new Date(CarbonImmutable::createFromDate(2019, 11, 27)->toDateString()),
                new Hour(4)
            ),
            new TimeCard(
                $employeeId,
                new Date(CarbonImmutable::createFromDate(2019, 11, 28)->toDateString()),
                new Hour(5)
            )
        ];
        $timeCardRepository = $this->createMock(TimeCardRepositoryInterface::class);
        $timeCardRepository->expects($this->once())
            ->method('findByEmployeeId')
            ->with($employeeId)
            ->willReturn($timeCards);

        $expectedPay = new Pay($employeeId, new Date('2019-11-29'), new Amount(12000));

        return [
            'friday' => ['2019-11-29', $hourlyEmployee, $timeCardRepository, $expectedPay],
            'saturday' => ['2019-11-30', $hourlyEmployee, $timeCardRepository, null],
            'php conference' => ['2019-12-01', $hourlyEmployee, $timeCardRepository, null],
        ];
    }

    /**
     * @param string $dateString
     * @param Employee $employee
     * @param TimeCardRepositoryInterface $timeCardRepository
     * @param Pay|null $expectedPay
     * @dataProvider providePayDayToHourlyClassification
     */
    public function testPayDayToHourlyClassification(
        string $dateString,
        Employee $employee,
        TimeCardRepositoryInterface $timeCardRepository,
        ?Pay $expectedPay
    ) {
        // arrange
        $employeeRepository = $this->createMock(EmployeeRepositoryInterface::class);
        $employeeRepository->method('factory')->willReturn(new EmployeeFactory());
        $employeeRepository->expects($this->once())
            ->method('all')
            ->willReturn([$employee]);

        $payRepository = $this->createMock(PayRepositoryInterface::class);
        if ($expectedPay) {
            $payRepository->expects($this->once())
                ->method('add')
                ->with($expectedPay);
        } else {
            $payRepository->expects($this->never());
        }

        $sut = new PayDay($employeeRepository, $timeCardRepository);

        // act
        $actual = $sut->pay($dateString);

        // assert
        $this->assertSame(1, $actual);
    }

//    public function testPayToSalariedEmployee()
//    {
//        // arrange
//        $employeeId = new EmployeeId('5.002.0186');
//        $employeeName = new Name('name');
//        $employeeAddress = new Address('address');
//        $salariedEmployee = new Employee($employeeId, $employeeName, $employeeAddress, new SalariedClassification(300000));
//        $employeeRepository = $this->createMock(EmployeeRepositoryInterface::class);
//        $employeeRepository->expects($this->once())
//            ->method('all')
//            ->willReturn([$salariedEmployee]);
//
//        $timeCardRepository = $this->createMock(TimeCardRepositoryInterface::class);
//
//        $sut = new PayDay($employeeRepository, $timeCardRepository);
//
//        // act
//        $actual = $sut->pay(CarbonImmutable::today()->toDateString());
//
//        // assert
//        $this->assertSame(30000, $actual);
//    }

    public function providePayDayToCommissionedClassification()
    {
        $commissionedEmployee = (new EmployeeFactory())->createCommissionedEmployee('5.002.0186', 'name', 'address', 100000, 1000);
        $employeeId = $commissionedEmployee->id();

        $expectedPay = new Pay($employeeId, new Date('2019-11-29'), new Amount(100000));
        $twoWeekAgoPay = new Pay($employeeId, new Date('2019-11-15'), new Amount(102000));
        $payRepositoryHaveTwoWeekAgoPay = $this->createMock(PayRepositoryInterface::class);
        $payRepositoryHaveTwoWeekAgoPay->method('getLast')
            ->with($employeeId)
            ->willReturn($twoWeekAgoPay);
        $payRepositoryHaveNoPay = $this->createMock(PayRepositoryInterface::class);
        $payRepositoryHaveNoPay->method('getLast')
            ->with($employeeId)
            ->willReturn(null);

        return [
            'friday' => ['2019-11-29', $commissionedEmployee, $payRepositoryHaveTwoWeekAgoPay, $expectedPay],
            'saturday' => ['2019-11-30', $commissionedEmployee, $payRepositoryHaveTwoWeekAgoPay, null],
            'php conference' => ['2019-12-01', $commissionedEmployee, $payRepositoryHaveTwoWeekAgoPay, null],
            'first friday' => ['2019-12-01', $commissionedEmployee, $payRepositoryHaveNoPay, $expectedPay],
//            'salary with commission pay' => ['2019-11-29', $commissionedEmployee, $timeCardRepository, $expectedPay],
        ];
    }

    /**
     * @param string $dateString
     * @param Employee $employee
     * @param TimeCardRepositoryInterface $timeCardRepository
     * @param Pay|null $expectedPay
     * @dataProvider providePayDayToHourlyClassification
     */
    public function testPayDayToCommissionedClassification(
        string $dateString,
        Employee $employee,
        TimeCardRepositoryInterface $timeCardRepository,
        ?Pay $expectedPay
    ) {
        // arrange
        $employeeRepository = $this->createMock(EmployeeRepositoryInterface::class);
        $employeeRepository->expects($this->once())
            ->method('all')
            ->willReturn([$employee]);

        $payRepository = $this->createMock(PayRepositoryInterface::class);
        if ($expectedPay) {
            $payRepository->expects($this->once())
                ->method('add')
                ->with($expectedPay);
        } else {
            $payRepository->expects($this->never());
        }

        $sut = new PayDay($employeeRepository, $timeCardRepository);

        // act
        $actual = $sut->pay($dateString);

        // assert
        $this->assertSame(1, $actual);
    }
}
