<?php declare(strict_types=1);

namespace Club\Club\Generic\DanceFloor;

use Club\Persons\Person;

/**
 * Club dance floor
 */
interface DanceFloor
{
    /**
     * Let the person in the dance floor
     *
     * @param Person $person
     *
     * @return void
     */
    public function letPersonIn(Person $person): void;

    /**
     * @return Person[]
     */
    public function getPersons(): array;
}