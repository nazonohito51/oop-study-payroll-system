<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification;

use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

class CommissionedPaySpecification implements PayDaySpecificationInterface
{
    private EmployeeId $id;

    public function __construct(EmployeeId $id)
    {
        $this->id = $id;
    }

    public function isSatisfiedBy(Date $date, PayRepositoryInterface $payRepository): bool
    {
        if ($date->isFriday() &&
            (
                $payRepository->getLast($this->id) === null ||
                $payRepository->getLast($this->id)->getDate()->isTwoWeekAgo($date)
            )
        ) {
            return true;
        }

        return false;
    }
}
