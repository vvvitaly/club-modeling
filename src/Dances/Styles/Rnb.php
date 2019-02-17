<?php declare(strict_types=1);

namespace Club\Dances\Styles;

use Club\Music\Genre;

/**
 * RnB
 */
final class Rnb implements DanceStyle
{
    /**
     * @inheritDoc
     */
    public function canDanceToMusic(Genre $musicGenre): bool
    {
        return $musicGenre->isRnb();
    }
}