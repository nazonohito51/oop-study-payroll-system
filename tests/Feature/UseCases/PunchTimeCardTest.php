<?php
declare(strict_types=1);

namespace Tests\Feature\UseCases;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use SalarySystem\Domain\Repositories\TimeCardRepositoryInterface;
use Tests\BaseTestCase;

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
        $expectedTimeCard = new TimeCard('5.002.0186', CarbonImmutable::today()->toDateString(), 8);
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
