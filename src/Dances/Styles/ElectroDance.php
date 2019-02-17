<?php declare(strict_types=1);

namespace Club\Dances\Styles;

use Club\Music\Genre;

/**
 * Electro dance
 */
final class ElectroDance implements DanceStyle
{
    /**
     * @inheritDoc
     */
    public function canDanceToMusic(Genre $musicGenre): bool
    {
        return $musicGenre->isElectroHouse();
    }
}