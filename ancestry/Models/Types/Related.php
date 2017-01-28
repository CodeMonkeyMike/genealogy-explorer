<?php declare(strict_types=1);

namespace Ancestry\Models\Types;

class Related
{
    const CHILD = 'child';
    const PARENT = 'parent';
    const COUSIN = 'cousin';

    protected static $relations = [
        self::CHILD,
        self::PARENT,
        self::COUSIN
    ];

    protected static $genderedRelationships = [
        self::CHILD => [
            Sex::MALE => 'son',
            Sex::FEMALE => 'daughter'
        ],
        self::PARENT => [
            Sex::MALE => 'father',
            Sex::FEMALE => 'mother'
        ],
        self::COUSIN => [
            Sex::MALE => 'cousin',
            Sex::FEMALE => 'cousin'
        ]
    ];

    const GREAT = 'great';
    const GRAND = 'grand';
    const REMOVED = 'removed';

    protected static $modifier = [
        self::GREAT,
        self::GRAND,
        self::REMOVED
    ];

    public function __construct($relation)
    {
        $this->relation = $this->parse($relation);
    }

    public static function parse($relation): string
    {
        if (is_string($relation)) {
            $relation = strtolower($relation);
            
            if (in_array($relation, self::$relations)) {
                return $relation;
            }
        }

        if (is_object($relation)) {
            if (get_class($relation) === self::class) {
                return self::parse($relation->get());
            }
        }

        throw new \Exception('Not a valid relation');
    }

    public function equals($value): bool
    {
        return $this->get() === self::parse($value);
    }

    public function genderedRelationship(Sex $sex): string
    {
        return $sex->isMale()
            ? Related::$genderedRelationships[$this->relation][Sex::MALE]
            : Related::$genderedRelationships[$this->relation][Sex::FEMALE];
    }

    public function get(): string
    {
        return $this->relation;
    }

    public function __toString(): string
    {
        return $this->get();
    }
}

