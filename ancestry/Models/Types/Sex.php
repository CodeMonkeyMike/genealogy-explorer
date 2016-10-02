<?php declare(strict_types=1);

namespace Ancestry\Models\Types;

class Sex
{
    const MALE = 'male';
    const FEMALE = 'female';

    public static $maleSpelling = ['man', 'male'];
    public static $femaleSpelling = ['woman', 'female'];

    protected static $sexes = [self::MALE, self::FEMALE];

    public function __construct($sex)
    {
        $this->sex = $this->parse($sex);
    }

    public static function parse($sex): string
    {
        if (is_string($sex)) {
            $sex = strtolower($sex);
            
            if (in_array($sex, self::$maleSpelling)) {
                return self::MALE;
            } elseif (in_array($sex, self::$femaleSpelling)) {
                return self::FEMALE;
            }
        }

        if (is_object($sex) && get_class($sex) === self::class) {
            return self::parse($sex->get());
        }

        throw new \Exception('Not a valid sex');
    }

    public function isMale(): bool
    {
        return $this->get() === self::MALE;
    }

    public function isFemale(): bool
    {
        return $this->get() === self::FEMALE;
    }

    public function equals($value): bool
    {
        return $this->get() === self::parse($value);
    }

    public function get(): string
    {
        return $this->sex;
    }

    public function __toString(): string
    {
        return $this->get();
    }
}

