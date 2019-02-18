<?php declare(strict_types=1);

namespace Club\MusicPlayer;

use Club\Infrastructure\Visitor;
use Club\MusicPlayer\PlayingStrategy\PlayingStrategy;
use Club\Music\Composition;
use Club\Music\Playlist;
use SplObjectStorage;

/**
 * Class GenericMusicPlayer
 */
final class GenericMusicPlayer implements MusicPlayer
{
    /**
     * @var PlayingStrategy
     */
    private $playingStrategy;

    /**
     * @var Composition
     */
    private $currentComposition;

    /**
     * @var SplObjectStorage
     */
    private $listeners;

    /**
     * GenericMusicPlayer constructor.
     *
     * @param PlayingStrategy $playingStrategy
     */
    public function __construct(PlayingStrategy $playingStrategy)
    {
        $this->playingStrategy = $playingStrategy;
        $this->listeners = new SplObjectStorage();
    }

    /**
     * @inheritDoc
     */
    public function startPlaying(Playlist $playlist): void
    {
        do {
            $this->currentComposition = $this->playingStrategy->playComposition($playlist);
            if ($this->currentComposition) {
                $this->notifyListeners($this->currentComposition);
            }
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

    /**
     * @inheritDoc
     */
    public function addListener(MusicListener $listener): void
    {
        $this->listeners->attach($listener);
        if ($this->currentComposition) {
            $listener->updateListeningComposition($this->currentComposition);
        }
    }

    /**
     * @inheritDoc
     */
    public function accept(Visitor $visitor): void
    {
        $visitor->visitMusicPlayer($this);
    }

    /**
     * @param Composition $composition
     */
    private function notifyListeners(Composition $composition): void
    {
        foreach ($this->listeners as $listener) {
            /** @var MusicListener $listener */
            $listener->updateListeningComposition($composition);
        }
    }
}