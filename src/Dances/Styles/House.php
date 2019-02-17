<?php declare(strict_types=1);

namespace Club\Dances\Styles;

use Club\Music\Genre;

/**
 * House dance
 */
final class House implements DanceStyle
{
    /**
     * @inheritDoc
     */
    public function canDanceToMusic(Genre $musicGenre): bool
    {
        return $musicGenre->isElectroHouse();
    }
}