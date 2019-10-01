<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Entities;

use PayrollSystem\Domain\ValueObjects\EmployeeId;
use PayrollSystem\Domain\ValueObjects\PayClassification;

final class Employee
{
    private EmployeeId $id;
    private string $name;
    private string $address;
    private PayClassification $paymentClassification;

    public function __construct(
        EmployeeId $id,
        string $name,
        string $address,
        PayClassification $paymentClassification
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->paymentClassification = $paymentClassification;
    }
}
