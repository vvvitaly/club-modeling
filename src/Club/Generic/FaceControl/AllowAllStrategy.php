<?php declare(strict_types=1);

namespace Club\Club\Generic\FaceControl;

use Club\Persons\Person;

/**
 * Allow enter for all
 */
class AllowAllStrategy implements FaceControlStrategy
{
    /**
     * @inheritDoc
     */
    public function canLetPersonIn(Person $person): bool
    {
        return true;
    }
}