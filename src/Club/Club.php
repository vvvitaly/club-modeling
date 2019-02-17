<?php declare(strict_types=1);

namespace Club\Club;

use Club\Persons\Person;

/**
 * Club
 */
interface Club
{
    /**
     * Let some person in. Throws NoEntryException if no entry allowed.
     *
     * @param Person $person
     *
     * @return void
     * @throws NoEntryException
     */
    public function letPersonIn(Person $person): void;

    /**
     * Play music in the club. Throws NoMusicLoadedException if there are no music was loaded.
     *
     * @throws NoMusicLoadedException
     */
    public function playMusic(): void;
}