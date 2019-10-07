<?php declare(strict_types=1);


namespace PayrollSystem\Application\UseCases;


final class PunchTimeCard
{
    public function punch(
        string $id,
        string $date,
        int $hour
    ): bool
    {
    }
}
