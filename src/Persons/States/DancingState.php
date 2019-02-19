<?php declare(strict_types=1);

namespace Club\Persons\States;

use Club\Dances\Styles\DanceStyle;
use Club\Persons\Person;

/**
 * Dance
 */
class DancingState implements PersonState
{
    use VisitableTrait, PersonAwareTrait;

    /**
     * @var DanceStyle
     */
    private $danceStyle;

    /**
     * @param Person $person
     * @param DanceStyle $danceStyle
     */
    public function __construct(Person $person, DanceStyle $danceStyle)
    {
        $this->setPerson($person);
        $this->danceStyle = $danceStyle;
    }

    /**
     * @return DanceStyle
     */
    public function getDanceStyle(): DanceStyle
    {
        return $this->danceStyle;
    }
}