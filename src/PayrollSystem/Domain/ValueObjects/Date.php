<?php declare(strict_types=1);


namespace PayrollSystem\Domain\ValueObjects;


use PayrollSystem\Domain\Exceptions\InvalidArgumentException;

final class Date
{
    private const DATE_FORMAT = 'Y-m-d';

    private string $date;

    /**
     * Date constructor.
     * @param string $date
     */
    public function __construct(string $date)
    {
        $d = \DateTimeImmutable::createFromFormat(self::DATE_FORMAT, $date);
        if (!$d || $d->format(self::DATE_FORMAT) !== $date) {
            throw new InvalidArgumentException();
        }
        $this->date = $date;
    }
}
