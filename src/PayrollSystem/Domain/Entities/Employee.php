<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Entities;

use PayrollSystem\Domain\Repositories\PayRepositoryInterface;
use PayrollSystem\Domain\Repositories\TimeCardRepositoryInterface;
use PayrollSystem\Domain\ValueObjects\Address;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Name;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayClassification;
use PayrollSystem\Domain\ValueObjects\PayClassification\PayDaySpecification\PayDaySpecificationInterface;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

final class Employee
{
    private EmployeeId $id;
    private Name $name;
    private Address $address;
    private PayClassification $payClassification;

    public function __construct(
        EmployeeId $id,
        Name $name,
        Address $address,
        PayClassification $paymentClassification
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->payClassification = $paymentClassification;
    }

    public function id(): EmployeeId
    {
        return $this->id;
    }

    public function isPayDay(Date $date, PayRepositoryInterface $payRepository): bool
    {
        return $this->getPayClassification()->isPayDay($this->id(), $date, $payRepository);
    }

    public function calculatePay(TimeCardRepositoryInterface $timeCardRepository): int
    {
        return $this->getPayClassification()->calculatePay($this, $timeCardRepository);
    }

    public function getPayDaySpecification(): PayDaySpecificationInterface
    {
        return $this->payClassification->getPayDaySpecification();
    }

    public function getPayClassification(): PayClassification
    {
        return $this->payClassification;
    }
}
