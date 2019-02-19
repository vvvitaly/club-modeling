<?php declare(strict_types=1);

namespace Club\Dances\Movements;

/**
 * Body parts
 */
final class BodyPart
{
    private const BODY = 'BODY';
    private const ARMS = 'ARMS';
    private const LEGS = 'LEGS';
    private const HEAD = 'HEAD';

    /**
     * @var string
     */
    private $partName;

    /**
     * @param string $partName
     */
    private function __construct(string $partName)
    {
        $this->partName = $partName;
    }

    /**
     * @param BodyPart $other
     *
     * @return bool
     */
    public function isEquals(BodyPart $other): bool
    {
        return $this->partName === $other->partName;
    }

    /**
     * @return bool
     */
    public function isBody(): bool
    {
        return $this->partName === self::BODY;
    }

    /**
     * @return bool
     */
    public function isArms(): bool
    {
        return $this->partName === self::ARMS;
    }

    /**
     * @return bool
     */
    public function isLegs(): bool
    {
        return $this->partName === self::LEGS;
    }

    /**
     * @return bool
     */
    public function isHead(): bool
    {
        return $this->partName === self::HEAD;
    }

    /**
     * @return BodyPart
     */
    public static function body(): BodyPart
    {
        return new self(self::BODY);
    }

    /**
     * @return BodyPart
     */
    public static function arms(): BodyPart
    {
        return new self(self::ARMS);
    }

    /**
     * @return BodyPart
     */
    public static function legs(): BodyPart
    {
        return new self(self::LEGS);
    }

    /**
     * @return BodyPart
     */
    public static function head(): BodyPart
    {
        return new self(self::HEAD);
    }
}