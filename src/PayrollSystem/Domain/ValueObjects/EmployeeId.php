<?php
declare(strict_types=1);

namespace PayrollSystem\Domain\ValueObjects;

use PayrollSystem\Domain\Exceptions\InvalidArgumentException;

class EmployeeId
{
    private string $id;

    public function __construct(string $id)
    {
        if (strlen($id) == 0) {
            throw new InvalidArgumentException();
        }

        $this->id = $id;
    }
}
