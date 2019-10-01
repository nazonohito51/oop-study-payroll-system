<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Repositories;

use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\Exceptions\SaveEntityException;

interface EmployeeRepositoryInterface extends RepositoryInterface
{
    public function findById(): Employee;

    /**
     * @param Employee $employee
     * @return bool
     * @throws SaveEntityException
     */
    public function add(Employee $employee): bool;
}
