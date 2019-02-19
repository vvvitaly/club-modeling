<?php declare(strict_types=1);

namespace Club\Persons\States;

use Club\Persons\Person;

/**
 * Go to the bar and drink vodka
 */
class DrinkingState implements PersonState
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