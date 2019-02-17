<?php declare(strict_types=1);

namespace Club\Dances\Styles;

use Club\Dances\Styles\Movements\MovementsSequence;
use Club\Music\Genre;

/**
 * Dance style
 */
interface DanceStyle
{
    /**
     * Get movements for this style.
     *
     * @return MovementsSequence
     */
    public function getMovementsSequence(): MovementsSequence;

    /**
     * Check if this style can dance to music genre
     *
     * @param Genre $musicGenre
     *
     * @return bool
     */
    public function canDanceToMusic(Genre $musicGenre): bool;
}