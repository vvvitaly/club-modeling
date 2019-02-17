<?php declare(strict_types=1);

namespace Club\Dances\Styles\Movements;

use Club\Dances\Movements\BodyPart;
use Club\Dances\Movements\SmoothMotion;

/**
 * Movements sequence for pop music dance
 */
final class PopMusicDanceMovements extends MovementsSequence
{
    public function __construct()
    {
        parent::__construct(
            new DanceMovement(BodyPart::body(), new SmoothMotion()),
            new DanceMovement(BodyPart::arms(), new SmoothMotion()),
            new DanceMovement(BodyPart::legs(), new SmoothMotion()),
            new DanceMovement(BodyPart::head(), new SmoothMotion())
        );
    }
}