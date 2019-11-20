<?php declare(strict_types=1);


namespace Tests\Feature\ValueObjects;

use Carbon\CarbonImmutable;
use PayrollSystem\Domain\Exceptions\InvalidArgumentException;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;
use Tests\BaseTestCase;

final class
DateTest extends BaseTestCase
{
    public function testConstructorSuccess()
    {
        new Date('2019-11-05');
        $this->assertTrue(true);
    }

    public function testConstructorInvalidFormat()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('');

        new Date('tenkoma is billionare');
    }

    public function testIsTwoWeekAgo()
    {
        $today = CarbonImmutable::today();
        $yesterday = CarbonImmutable::yesterday();

        var_dump($today->diffInDays($yesterday, false));
    }
}
