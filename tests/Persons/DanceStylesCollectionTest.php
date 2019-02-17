<?php declare(strict_types=1);

namespace tests\Persons;

use Club\Dances\Styles\DanceStyle;
use Club\Music\Genre;
use Club\Persons\DanceStylesCollection;
use PHPUnit\Framework\TestCase;


/**
 * Class StylesCollectionTest
 */
class DanceStylesCollectionTest extends TestCase
{
    public function testGetStyleForMusic(): void
    {
        $rnb = Genre::rnb();

        $deniedDance = self::getStyle(false);
        $allowedDance = self::getStyle(true);
        $anotherAllowedDance = self::getStyle(true);

        $styles = new DanceStylesCollection(
            $deniedDance,
            $allowedDance,
            $anotherAllowedDance
        );

        self::assertSame($allowedDance, $styles->getDanceForMusic($rnb));
    }

    /**
     * @param bool $isCanDance
     *
     * @return DanceStyle
     */
    private static function getStyle(bool $isCanDance): DanceStyle
    {
        return new class($isCanDance) implements DanceStyle {

            /** @var bool */
            private $isCanDance;

            /**
             * @param bool $isCanDance
             */
            public function __construct(bool $isCanDance)
            {
                $this->isCanDance = $isCanDance;
            }

            /**
             * @inheritDoc
             */
            public function canDanceToMusic(Genre $musicGenre): bool
            {
                return $this->isCanDance;
            }
        };
    }
}