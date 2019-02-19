<?php declare(strict_types=1);

namespace Club\Emulating;

use Club\Music\Composition;
use Club\Music\Playlist;
use Club\MusicPlayer\PlayingStrategy\PlayingStrategy;

/**
 * Emulating real playing
 */
class EmulatingPlayingTrackStrategy implements PlayingStrategy
{
    /**
     * @var PlayingStrategy
     */
    private $wrapped;

    /**
     * @var int playing duration in seconds
     */
    private $duration;

    /**
     * @var bool
     */
    private $isFirstTrack = true;

    /**
     * @param PlayingStrategy $wrapped
     * @param int $duration
     */
    public function __construct(PlayingStrategy $wrapped, int $duration)
    {
        $this->wrapped = $wrapped;
        $this->duration = $duration;
    }

    /**
     * @inheritDoc
     */
    public function playComposition(Playlist $playlist): ?Composition
    {
        if (!$this->isFirstTrack) {
            usleep($this->duration * 1000000);
        }
        $this->isFirstTrack = false;
        return $this->wrapped->playComposition($playlist);
    }
}