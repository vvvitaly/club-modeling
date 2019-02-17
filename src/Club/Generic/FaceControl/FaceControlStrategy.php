<?php declare(strict_types=1);

namespace Club\Club\Generic\FaceControl;

use Club\Persons\Person;

/**
 * Face control strategy
 */
interface FaceControlStrategy
{
    /**
     * Check if person can be let in the club
     *
     * @param Person $person
     *
     * @return bool
     */
    public function canLetPersonIn(Person $person): bool;
}