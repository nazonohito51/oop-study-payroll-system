<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Entities;

use PayrollSystem\Domain\ValueObjects\Address;
use PayrollSystem\Domain\ValueObjects\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Name;
use PayrollSystem\Domain\ValueObjects\PayClassification;

final class Employee
{
    private EmployeeId $id;
    private Name $name;
    private Address $address;
    private PayClassification $paymentClassification;

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
        $this->paymentClassification = $paymentClassification;
    }
}
