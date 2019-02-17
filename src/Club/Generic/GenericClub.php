<?php declare(strict_types=1);

namespace Club\Club\Generic;

use Club\Club\Club;
use Club\Club\Generic\DanceFloor\DanceFloor;
use Club\Club\Generic\FaceControl\FaceControlStrategy;
use Club\MusicPlayer\MusicPlayer;
use Club\Club\NoEntryException;
use Club\Persons\Person;

/**
 * Class GenericClub
 */
final class GenericClub implements Club
{
    /**
     * @var FaceControlStrategy
     */
    private $faceControlStrategy;

    /**
     * @var DanceFloor
     */
    private $danceFloor;

    /**
     * @var MusicPlayer
     */
    private $musicPlayer;

    /**
     * GenericClub constructor.
     *
     * @param FaceControlStrategy $faceControlStrategy
     * @param DanceFloor $danceFloor
     * @param MusicPlayer $musicPlayer
     */
    public function __construct(
        FaceControlStrategy $faceControlStrategy,
        DanceFloor $danceFloor,
        MusicPlayer $musicPlayer
    )
    {
        $this->faceControlStrategy = $faceControlStrategy;
        $this->danceFloor = $danceFloor;
        $this->musicPlayer = $musicPlayer;
    }

    /**
     * @inheritDoc
     */
    public function letPersonIn(Person $person): void
    {
        if (!$this->faceControlStrategy->canLetPersonIn($person)) {
            throw new NoEntryException($person, 'Can not let this person in');
        }

        $this->danceFloor->letPersonIn($person);
    }

    /**
     * @inheritDoc
     */
    public function playMusic(): void
    {
        $this->musicPlayer->startPlaying();
    }
}