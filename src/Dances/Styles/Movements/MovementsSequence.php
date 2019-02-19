<?php declare(strict_types=1);

namespace Club\Dances\Styles\Movements;

/**
 * Dance movements
 */
class MovementsSequence
{
    /**
     * @var DanceMovement[]
     */
    private $movements;

    /**
     * @param DanceMovement ...$danceMovements
     */
    public function __construct(DanceMovement ...$danceMovements)
    {
        $this->movements = $danceMovements;
    }

    /**
     * @return DanceMovement[]
     */
    public function toArray(): array
    {
        return $this->movements;
    }
}