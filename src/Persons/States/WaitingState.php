<?php declare(strict_types=1);

namespace Club\Persons\States;

use Club\Persons\Person;

/**
 * Do nothing, waiting changes
 */
class WaitingState implements PersonState
{
    use VisitableTrait, PersonAwareTrait;

    /**
     * @param Person $person
     */
    public function __construct(Person $person)
    {
        $this->setPerson($person);
    }
}