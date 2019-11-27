<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Repositories;

use PayrollSystem\Domain\Entities\Employee;
use PayrollSystem\Domain\Exceptions\SaveEntityException;
use PayrollSystem\Domain\Factories\EmployeeFactory;

interface EmployeeRepositoryInterface extends RepositoryInterface
{
    public function factory(): EmployeeFactory;

    public function findById(): Employee;

    /**
     * @return Employee[]
     */
    public function all(): array;

    /**
     * @param Employee $employee
     * @return bool
     * @throws SaveEntityException
     */
    public function add(Employee $employee): bool;
}
