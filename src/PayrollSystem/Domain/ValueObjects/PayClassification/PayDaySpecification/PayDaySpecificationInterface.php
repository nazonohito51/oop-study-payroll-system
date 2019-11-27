<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification;

use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

interface PayDaySpecificationInterface
{
    public function isSatisfiedBy(EmployeeId $id, PayRepositoryInterface $payRepository, Date $date): bool;
}
