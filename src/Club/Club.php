<?php declare(strict_types=1);

namespace Club\Club;

use Club\Infrastructure\Visitable;
use Club\Music\Playlist;
use Club\MusicPlayer\MusicPlayer;
use Club\Persons\Person;

/**
 * Club
 */
interface Club extends Visitable
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
     * @param Playlist $playlist
     *
     * @return void
     */
    public function usePlaylist(Playlist $playlist): void;

    /**
     * Play music in the club.
     */
    public function playMusic(): void;

    /**
     * @return MusicPlayer
     */
    public function getMusicPlayer(): MusicPlayer;

    /**
     * Get club visitors
     *
     * @return \Traversable
     */
    public function getPersons(): \Traversable;
}