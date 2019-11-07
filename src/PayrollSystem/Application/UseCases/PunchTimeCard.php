<?php declare(strict_types=1);


namespace PayrollSystem\Application\UseCases;


use PayrollSystem\Domain\Entities\TimeCard;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Date;
use PayrollSystem\Domain\ValueObjects\EmployeeId;

final class PunchTimeCard
{
    private TimeCardRepositoryInterface $repository;

    /**
     * PunchTimeCard constructor.
     * @param TimeCardRepositoryInterface $repository
     */
    public function __construct(TimeCardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $string
     * @param string $toDateString
     * @param int $int
     * @return bool
     */
    public function punch(string $string, string $toDateString, int $int)
    {
        $timeCard = new TimeCard(
            new EmployeeId($string),
            new Date($toDateString),
            $int
        );

        return $this->repository->add($timeCard);;
    }
}

// '5.002.0186', CarbonImmutable::today()->toDateString(), 8
