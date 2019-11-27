<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Repositories;

use PayrollSystem\Domain\Entities\TimeCard;
use PayrollSystem\Domain\Exceptions\SaveEntityException;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;

interface TimeCardRepositoryInterface extends RepositoryInterface
{
    /**
     * @param EmployeeId $employeeId
     * @return TimeCard[]
     */
    public function findByEmployeeId(EmployeeId $employeeId): array;

    /**
     * @param TimeCard $timeCard
     * @return bool
     * @throws SaveEntityException
     */
    public function add(TimeCard $timeCard): bool;
}
