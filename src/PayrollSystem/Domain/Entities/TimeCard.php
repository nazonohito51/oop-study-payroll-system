<?php declare(strict_types=1);

namespace PayrollSystem\Domain\Entities;

use PayrollSystem\Domain\ValueObjects\Date;
use PayrollSystem\Domain\ValueObjects\EmployeeId;

final class TimeCard
{
    private EmployeeId $employeeId;

    private Date $date;

    private int $hour;

    /**
     * TimeCard constructor.
     * @param EmployeeId $employeeId
     * @param Date $date
     * @param int $hour
     */
    public function __construct(
        EmployeeId $employeeId,
        Date $date,
        int $hour
    )
    {
        $this->employeeId = $employeeId;
        $this->date = $date;
        $this->hour = $hour;
    }
}
