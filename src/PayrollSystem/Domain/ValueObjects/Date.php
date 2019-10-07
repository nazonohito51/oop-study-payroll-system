<?php declare(strict_types=1);


namespace PayrollSystem\Domain\ValueObjects;


use Carbon\CarbonImmutable;

final class Date
{
    private CarbonImmutable $date;

    /**
     * Date constructor.
     * @param string $date
     */
    public function __construct(
        string $date
    )
    {
        $formattedDate = CarbonImmutable::createFromFormat('Y-m-d', $date);
        $this->date = $formattedDate;
    }
}
