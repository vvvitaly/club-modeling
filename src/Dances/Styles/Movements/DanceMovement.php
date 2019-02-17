<?php declare(strict_types=1);

namespace Club\Dances\Styles\Movements;

use Club\Dances\Movements\BodyPart;
use Club\Dances\Movements\Movement;

/**
 * Body part movement
 */
final class DanceMovement
{
    /**
     * @var BodyPart
     */
    private $bodyPart;

    /**
     * @var Movement
     */
    private $movement;

    /**
     * DanceMovement constructor.
     *
     * @param \Club\Dances\Movements\BodyPart $bodyPart
     * @param Movement $movement
     */
    public function __construct(BodyPart $bodyPart, Movement $movement)
    {
        $this->bodyPart = $bodyPart;
        $this->movement = $movement;
    }
}