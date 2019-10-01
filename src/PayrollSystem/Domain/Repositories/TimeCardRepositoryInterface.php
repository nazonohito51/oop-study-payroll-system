<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Repositories;

use PayrollSystem\Domain\Entities\TimeCard;
use PayrollSystem\Domain\Exceptions\SaveEntityException;

interface TimeCardRepositoryInterface extends RepositoryInterface
{
    public function findByEmployeeId(int $employeeId): TimeCard;

    /**
     * @param TimeCard $timeCard
     * @return bool
     * @throws SaveEntityException
     */
    public function add(TimeCard $timeCard): bool;
}
