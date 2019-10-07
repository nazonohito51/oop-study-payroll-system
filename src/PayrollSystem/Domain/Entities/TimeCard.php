<?php declare(strict_types=1);


namespace PayrollSystem\Domain\Entities;


use PayrollSystem\Domain\ValueObjects\Date;
use PayrollSystem\Domain\ValueObjects\EmployeeId;

final class TimeCard
{
    private EmployeeId $employeeId;
    private Date $date;

    /**
     * TimeCard constructor.
     * @param EmployeeId $employeeId
     * @param Date $date
     */
    public function __construct(EmployeeId $employeeId, Date $date)
    {
        $this->employeeId = $employeeId;
        $this->date = $date;
    }
}
