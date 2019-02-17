<?php declare(strict_types=1);

namespace Club\Infrastructure;

use Club\Club\Club;
use Club\Dances\Styles\Movements\DanceMovement;
use Club\MusicPlayer\MusicPlayer;
use Club\Persons\Person;
use Club\Persons\States\PersonState;

/**
 * Visitor for club components
 */
interface Visitor
{
    /**
     * @param Club $club
     */
    public function visitClub(Club $club): void;

    /**
     * @param MusicPlayer $musicPlayer
     */
    public function visitMusicPlayer(MusicPlayer $musicPlayer): void;

    /**
     * @param Person $person
     */
    public function visitPerson(Person $person): void;

    /**
     * @param PersonState $personState
     */
    public function visitPersonState(PersonState $personState): void;

    /**
     * @param DanceMovement $movement
     */
    public function visitDancingMovement(DanceMovement $movement): void;
}