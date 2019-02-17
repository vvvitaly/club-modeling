<?php declare(strict_types=1);

namespace Club\Dances\Styles;

use Club\Music\Genre;

/**
 * Hip hop dance
 */
final class HipHop implements DanceStyle
{
    /**
     * @inheritDoc
     */
    public function canDanceToMusic(Genre $musicGenre): bool
    {
        return $musicGenre->isRnb();
    }
}