<?php declare(strict_types=1);

namespace Club\Dances\Styles\Movements;

/**
 * Dance movements
 */
interface MovementsSequence
{
    /**
     * @return DanceMovement[]
     */
    public function toArray(): array;
}