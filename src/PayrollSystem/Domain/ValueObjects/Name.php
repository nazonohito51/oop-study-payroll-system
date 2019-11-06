<?php declare(strict_types=1);


namespace PayrollSystem\Domain\ValueObjects;


use PayrollSystem\Domain\Exceptions\InvalidArgumentException;

final class Name
{
    private string $name;

    /**
     * Name constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        if (strlen($name) == 0) {
            throw new InvalidArgumentException();
        }
        $this->name = $name;
    }
}
