<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification;

use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

class CommissionedPayDaySpecification implements PayDaySpecificationInterface
{
    private EmployeeId $id;

    public function __construct(EmployeeId $id)
    {
        $this->id = $id;
    }

    public function isSatisfiedBy(EmployeeId $id, PayRepositoryInterface $payRepository, Date $date): bool
    {
        if ($date->isFriday() &&
            (
                $this->lastPayIsTwoWeekAgo($date, $payRepository) || $this->employeeHaveNoPay($payRepository)
            )
        ) {
            return true;
        }

        return false;
    }

    private function lastPayIsTwoWeekAgo(Date $date, PayRepositoryInterface $payRepository): bool
    {
        $lastPay = $payRepository->getLast($this->id);
        return !is_null($lastPay) && $lastPay->getDate()->isTwoWeekAgo($date);
    }

    private function employeeHaveNoPay(PayRepositoryInterface $payRepository): bool
    {
        return $payRepository->getLast($this->id) === null;
    }
}
