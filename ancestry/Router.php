<?php declare(strict_types=1);

namespace Ancestry;

use Ancestry\Models\{Death, Marriage, Person, Record, Relation};

class Router
{
    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }

    public function entry()
    {
        return Person::find(52);
    }

    public function summa(int $foo): int
    {
        return $foo;
    }
}
