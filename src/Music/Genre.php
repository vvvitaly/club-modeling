<?php declare(strict_types=1);

namespace Club\Music;

/**
 * Composition genre
 */
final class Genre
{
    private const RNB = 'RNB';
    private const ELECTROHOUSE = 'ELECTROHOUSE';
    private const POP_MUSIC = 'POP_MUSIC';

    /**
     * @var string Genre name
     */
    private $name;

    /**
     * Genre constructor.
     *
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param Genre $other
     *
     * @return bool
     */
    public function isEquals(Genre $other): bool
    {
        return $this->name === $other->name;
    }

    /**
     * @return bool
     */
    public function isRnb(): bool
    {
        return $this->name === self::RNB;
    }

    /**
     * @return bool
     */
    public function isElectroHouse(): bool
    {
        return $this->name === self::ELECTROHOUSE;
    }

    /**
     * @return bool
     */
    public function isPopMusic(): bool
    {
        return $this->name === self::POP_MUSIC;
    }

    /**
     * @return Genre
     */
    public static function rnb(): Genre
    {
        return new self(self::RNB);
    }

    /**
     * @return Genre
     */
    public static function electroHouse(): Genre
    {
        return new self(self::ELECTROHOUSE);
    }

    /**
     * @return Genre
     */
    public static function popMusic(): Genre
    {
        return new self(self::POP_MUSIC);
    }
}