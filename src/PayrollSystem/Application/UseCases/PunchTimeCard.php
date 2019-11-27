<?php declare(strict_types=1);


namespace PayrollSystem\Application\UseCases;


use PayrollSystem\Domain\Entities\TimeCard;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Time\Amount\Hour;

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
     * @param int $hour
     * @return bool
     */
    public function punch(string $string, string $toDateString, int $hour)
    {
        $timeCard = new TimeCard(
            new EmployeeId($string),
            new Date($toDateString),
            new Hour($hour)
        );

        return $this->repository->add($timeCard);
    }
}
