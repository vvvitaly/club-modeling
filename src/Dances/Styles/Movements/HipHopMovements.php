<?php declare(strict_types=1);

namespace Club\Dances\Styles\Movements;

use Club\Dances\Movements\BodyPart;
use Club\Dances\Movements\BackAndForthWiggle;
use Club\Dances\Movements\HalfBentLimbs;

/**
 * Movements sequence for hip hop and RnB
 */
final class HipHopMovements extends MovementsSequence
{
    /**
     * HipHopMovements constructor.
     */
    public function __construct()
    {
        parent::__construct(
            new DanceMovement(BodyPart::body(), new BackAndForthWiggle()),
            new DanceMovement(BodyPart::legs(), new HalfBentLimbs()),
            new DanceMovement(BodyPart::arms(), new HalfBentLimbs()),
            new DanceMovement(BodyPart::head(), new BackAndForthWiggle())
        );
    }
}