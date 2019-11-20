<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\Repositories;

use PayrollSystem\Domain\Entities\Pay;
use PayrollSystem\Domain\ValueObjects\Identifier\EmployeeId;

interface PayRepositoryInterface extends RepositoryInterface
{
    public function getLast(EmployeeId $id): Pay;
}
