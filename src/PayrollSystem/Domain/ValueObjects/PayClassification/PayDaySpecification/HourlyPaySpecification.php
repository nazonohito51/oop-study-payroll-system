<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification;

use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

class HourlyPaySpecification implements PayDaySpecificationInterface
{
    public function isSatisfiedBy(Date $date, PayRepositoryInterface $payRepository): bool
    {
        // TODO: Implement isSatisfiedBy() method.
    }
}
