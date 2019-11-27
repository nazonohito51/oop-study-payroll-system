<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects\PayClassification;


use PayrollSystem\Domain\Exceptions\InvalidArgumentException;
use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayClassification;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification\PayDaySpecificationInterface;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

class HourlyClassification implements PayClassification
{
    private int $hourlyRate;

    public function __construct(int $hourlyRate)
    {
        if ($hourlyRate <= 0) {
            throw new InvalidArgumentException();
        }
        $this->hourlyRate = $hourlyRate;
    }

    public function getPayDaySpecification(): PayDaySpecificationInterface
    {
        // TODO: Implement getPayDaySpecification() method.
    }
}
