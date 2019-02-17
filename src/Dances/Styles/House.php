<?php declare(strict_types=1);

namespace Club\Dances\Styles;

use Club\Dances\Styles\Movements\ElectroDanceMovements;
use Club\Dances\Styles\Movements\LazyMovementsSequence;
use Club\Dances\Styles\Movements\MovementsSequence;
use Club\Music\Genre;

/**
 * House dance
 */
final class House implements DanceStyle
{
    /**
     * @var ElectroDanceMovements
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
        return $musicGenre->isElectroHouse();
    }

    /**
     * @return ElectroDanceMovements
     */
    public function getMovementsSequence(): MovementsSequence
    {
        return $this->movements;
    }
}