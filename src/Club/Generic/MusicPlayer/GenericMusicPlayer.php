<?php declare(strict_types=1);

namespace Club\Club\Generic\MusicPlayer;

use Club\Club\Generic\MusicPlayer\PlayingStrategy\PlayingStrategy;
use Club\Music\Composition;
use Club\Music\Playlist;

/**
 * Class GenericMusicPlayer
 */
final class GenericMusicPlayer implements MusicPlayer
{
    /**
     * @var Playlist
     */
    private $playlist;

    /**
     * @var PlayingStrategy
     */
    private $playingStrategy;

    /**
     * @var Composition
     */
    private $currentComposition;

    /**
     * GenericMusicPlayer constructor.
     *
     * @param Playlist $playlist
     * @param PlayingStrategy $playingStrategy
     */
    public function __construct(Playlist $playlist, PlayingStrategy $playingStrategy)
    {
        $this->playlist = $playlist;
        $this->playingStrategy = $playingStrategy;
    }

    /**
     * @inheritDoc
     */
    public function startPlaying(): void
    {
        do {
            $this->currentComposition = $this->playingStrategy->playComposition($this->playlist);
        } while ($this->currentComposition !== null);
    }

    /**
     * @inheritDoc
     */
    public function getCurrentComposition(): Composition
    {
        if (!$this->currentComposition) {
            throw new PlayerStoppedException('Player is not playing');
        }

        return $this->currentComposition;
    }
}