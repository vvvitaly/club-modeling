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
     * @var int playing duration in microseconds
     */
    private $duration;

    /**
     * @var bool
     */
    private $isFirstTrack = true;

    /**
     * EmulatingPlayingTrackStrategy constructor.
     *
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
            usleep($this->duration);
        }
        $this->isFirstTrack = false;
        return $this->wrapped->playComposition($playlist);
    }
}