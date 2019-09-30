<?php
declare(strict_types=1);

namespace SalarySystem\Domain\Repositories;

use SalarySystem\Domain\Entities\Employee;
use SalarySystem\Domain\Exceptions\SaveEntityException;

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
