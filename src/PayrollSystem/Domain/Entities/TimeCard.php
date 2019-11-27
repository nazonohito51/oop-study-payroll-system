<?php declare(strict_types=1);

namespace PayrollSystem\Domain\Entities;

use PayrollSystem\Domain\ValueObjects\Time\Oclock\Date;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;
use PayrollSystem\Domain\ValueObjects\Time\Amount\Hour;

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

    public function getHour(): Hour
    {
        return $this->hour;
    }
}
