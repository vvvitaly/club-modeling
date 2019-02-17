<?php declare(strict_types=1);

namespace Club\Dances\Styles;

use Club\Music\Genre;

/**
 * Pop music dance
 */
final class PopMusicDance implements DanceStyle
{
    /**
     * @inheritDoc
     */
    public function canDanceToMusic(Genre $musicGenre): bool
    {
        return $musicGenre->isPopMusic();
    }
}