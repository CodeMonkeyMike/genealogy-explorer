<?php declare(strict_types=1);

namespace Ancestry\Models\Types;

class Sex
{
    /** @var string */
    const MALE = 'male';

    /** @var string */
    const FEMALE = 'female';

    /** @var string[] */
    public static $maleSpelling = ['man', 'male'];

    /** @var string[] */
    public static $femaleSpelling = ['woman', 'female'];

    /** @var string[] */
    protected static $sexes = [self::MALE, self::FEMALE];

    /** @param Sex|string $sex */
    public function __construct($sex)
    {
        $this->sex = $this->parse($sex);
    }

    /** @param Sex|string $sex */
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

        if (is_object($sex)) {
            if (get_class($sex) === self::class) {
                return self::parse($sex->get());
            }
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

    /** @param Sex|string $value */
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

