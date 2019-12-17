<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification;

use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

class CommissionedPayDaySpecification implements PayDaySpecificationInterface
{
    public function isSatisfiedBy(EmployeeId $id, PayRepositoryInterface $payRepository, Date $date): bool
    {
        if ($date->isFriday() &&
            (
                $this->lastPayIsTwoWeekAgo($id, $date, $payRepository) ||
                $this->employeeHaveNoPay($id, $payRepository)
            )
        ) {
            return true;
        }

        return false;
    }

    private function lastPayIsTwoWeekAgo(EmployeeId $id, Date $date, PayRepositoryInterface $payRepository): bool
    {
        $lastPay = $payRepository->getLast($id);
        return !is_null($lastPay) && $lastPay->getDate()->diffInDaysFrom($date) === 14;
    }

    private function employeeHaveNoPay(EmployeeId $id, PayRepositoryInterface $payRepository): bool
    {
        return $payRepository->getLast($id) === null;
    }
}
