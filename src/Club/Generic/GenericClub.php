<?php declare(strict_types=1);

namespace Club\Club\Generic;

use Club\Club\Club;
use Club\Club\Generic\FaceControl\FaceControlStrategy;
use Club\Infrastructure\Visitor;
use Club\Music\Playlist;
use Club\MusicPlayer\MusicPlayer;
use Club\Club\NoEntryException;
use Club\Persons\Person;
use SplObjectStorage;

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
     * @var MusicPlayer
     */
    private $musicPlayer;

    /**
     * @var Playlist
     */
    private $playlist;

    /**
     * @var SplObjectStorage
     */
    private $visitors;

    /**
     * GenericClub constructor.
     *
     * @param FaceControlStrategy $faceControlStrategy
     * @param MusicPlayer $musicPlayer
     */
    public function __construct(
        FaceControlStrategy $faceControlStrategy,
        MusicPlayer $musicPlayer
    )
    {
        $this->faceControlStrategy = $faceControlStrategy;
        $this->musicPlayer = $musicPlayer;
        $this->visitors = new SplObjectStorage();
    }

    /**
     * @inheritDoc
     */
    public function letPersonIn(Person $person): void
    {
        if (!$this->faceControlStrategy->canLetPersonIn($person)) {
            throw new NoEntryException($person, 'Can not let this person in');
        }

        $this->visitors->attach($person);
        $this->musicPlayer->addListener($person);
    }

    /**
     * @inheritDoc
     */
    public function usePlaylist(Playlist $playlist): void
    {
        $this->playlist = $playlist;
    }

    /**
     * @inheritDoc
     */
    public function playMusic(): void
    {
        $this->musicPlayer->startPlaying($this->playlist);
    }

    /**
     * @inheritDoc
     */
    public function accept(Visitor $visitor): void
    {
        $visitor->visitClub($this);
    }

    /**
     * @return MusicPlayer
     */
    public function getMusicPlayer(): MusicPlayer
    {
        return $this->musicPlayer;
    }

    /**
     * @inheritDoc
     */
    public function getPersons(): \Traversable
    {
        return $this->visitors;
    }
}