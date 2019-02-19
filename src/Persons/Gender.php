<?php declare(strict_types=1);

namespace Club\Persons;

/**
 * People genders
 */
final class Gender
{
    private const MALE = 'MALE';
    private const FEMALE = 'FEMALE';

    /**
     * @var string
     */
    private $gender;

    /**
     * @param string $gender
     */
    private function __construct(string $gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return bool
     */
    public function isMale(): bool
    {
        return $this->gender === self::MALE;
    }

    /**
     * @return bool
     */
    public function isFemale(): bool
    {
        return $this->gender === self::FEMALE;
    }

    /**
     * @return Gender
     */
    public static function male(): Gender
    {
        return new self(self::MALE);
    }

    /**
     * @return Gender
     */
    public static function female(): Gender
    {
        return new self(self::FEMALE);
    }
}