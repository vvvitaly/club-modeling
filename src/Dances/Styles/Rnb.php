<?php declare(strict_types=1);

namespace Club\Dances\Styles;

use Club\Dances\Styles\Movements\LazyMovementsSequence;
use Club\Dances\Styles\Movements\MovementsSequence;
use Club\Music\Genre;

/**
 * RnB
 */
final class Rnb implements DanceStyle
{
    /**
     * @var MovementsSequence
     */
    private $movements;

    public function __construct()
    {
        $this->movements = new LazyMovementsSequence($this);
    }

    /**
     * @inheritDoc
     */
    public function canDanceToMusic(Genre $musicGenre): bool
    {
        return $musicGenre->isRnb();
    }

    /**
     * @inheritDoc
     */
    public function getMovementsSequence(): MovementsSequence
    {
        return $this->movements;
    }
}