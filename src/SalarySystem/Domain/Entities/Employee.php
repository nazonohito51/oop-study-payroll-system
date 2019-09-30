<?php
declare(strict_types=1);

namespace SalarySystem\SalarySystem\Domain\Entities;

final class Employee
{
    /**
     * Employee constructor.
     *
     * @param string $id
     * @param string $name
     * @param string $address
     * @param int    $salariedClassification
     */
    public function __construct(
        string $id,
        string $name,
        string $address,
        int $salariedClassification
    )
    {
    }
}