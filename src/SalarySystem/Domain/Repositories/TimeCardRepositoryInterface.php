<?php
declare(strict_types=1);

namespace SalarySystem\Domain\Repositories;

use SalarySystem\Domain\Entities\TimeCard;
use SalarySystem\Domain\Exceptions\SaveEntityException;

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
