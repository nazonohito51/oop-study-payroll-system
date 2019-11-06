<?php
declare(strict_types=1);

namespace Tests\Feature\UseCases;

use Carbon\CarbonImmutable;
use PayrollSystem\Application\UseCases\PunchTimeCard;
use PayrollSystem\Domain\Entities\TimeCard;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Date;
use PayrollSystem\Domain\ValueObjects\EmployeeId;
use Tests\BaseTestCase;
use PayrollSystem\Domain\Entities\TimeCard;
use PayrollSystem\Application\UseCases\PunchTimeCard;

class PunchTimeCardTest extends BaseTestCase
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

    public function testPunch()
    {
        // arrange
        $expectedTimeCard = new TimeCard(
            new EmployeeId('5.002.0186'),
            new Date(CarbonImmutable::today()->toDateString()),
            8
        );
        $repository = $this->createMock(TimeCardRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('add')
            ->with($expectedTimeCard)
            ->willReturn(true);
        $sut = new PunchTimeCard($repository);

        // act
        $ret = $sut->punch('5.002.0186', CarbonImmutable::today()->toDateString(), 8);

        // assert
        $this->assertTrue($ret);
    }
}
