<?php declare(strict_types=1);

namespace Club\Dances\Styles\Movements;

use Club\Dances\Movements\BackAndForthWiggle;
use Club\Dances\Movements\BarelyMoving;
use Club\Dances\Movements\BodyPart;
use Club\Dances\Movements\RhythmMovement;
use Club\Dances\Movements\Rotating;

/**
 * Movements sequence for electrodance and house
 */
final class ElectroDanceMovements extends MovementsSequence
{
    public function __construct()
    {
        parent::__construct(
            new DanceMovement(BodyPart::body(), new BackAndForthWiggle()),
            new DanceMovement(BodyPart::head(), new BarelyMoving()),
            new DanceMovement(BodyPart::arms(), new Rotating()),
            new DanceMovement(BodyPart::legs(), new RhythmMovement())
        );
    }
}