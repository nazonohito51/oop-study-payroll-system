<?php declare(strict_types=1);

namespace PayrollSystem\Domain\Entities;

use PayrollSystem\Domain\ValueObjects\Date;
use PayrollSystem\Domain\ValueObjects\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Hour;

final class TimeCard
{
    private EmployeeId $employeeId;

    private Date $date;

    private Hour $hour;

    /**
     * TimeCard constructor.
     * @param EmployeeId $employeeId
     * @param Date $date
     * @param Hour $hour
     */
    public function __construct(
        EmployeeId $employeeId,
        Date $date,
        Hour $hour
    )
    {
        $this->employeeId = $employeeId;
        $this->date = $date;
        $this->hour = $hour;
    }
}
