<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Entities;

use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Money\Amount;
use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;

final class Pay
{
    private EmployeeId $id;
    private Date $date;
    private Amount $amount;

    public function __construct(EmployeeId $id, Date $date, Amount $amount)
    {
        $this->id = $id;
        $this->date = $date;
        $this->amount = $amount;
    }

    public function getDate(): Date
    {
        return $this->date;
    }
}
