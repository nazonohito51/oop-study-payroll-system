<?php declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\Time\Amount;

use PayrollSystem\Domain\Exceptions\InvalidArgumentException;

final class Hour
{
    private int $amount;

    /**
     * Date constructor.
     * @param int $hour
     */
    public function __construct(int $hour)
    {
        if ($hour < 1) {
            throw new InvalidArgumentException();
        }
        $this->amount = $hour;
    }
}
