<?php declare(strict_types=1);

namespace Club\Dances\Styles;

use Club\Dances\Styles\Movements\LazyMovementsSequence;
use Club\Dances\Styles\Movements\MovementsSequence;
use Club\Music\Genre;

/**
 * Pop music dance
 */
final class PopMusicDance implements DanceStyle
{
    /**
     * @var MovementsSequence
     */
    private $movements;

    /**
     * PopMusicDance constructor.
     */
    public function __construct()
    {
        $this->movements = new LazyMovementsSequence($this);
    }

    /**
     * @inheritDoc
     */
    public function canDanceToMusic(Genre $musicGenre): bool
    {
        return $musicGenre->isPopMusic();
    }

    /**
     * @inheritDoc
     */
    public function getMovementsSequence(): MovementsSequence
    {
        return $this->movements;
    }
}