<?php declare(strict_types=1);

namespace Club\MusicPlayer\PlayingStrategy;

use Club\Music\Composition;
use Club\Music\Playlist;

/**
 * Playing strategy that denies playing music more then specified number of times.
 */
class LimitPlaysCount implements PlayingStrategy
{
    /**
     * @var PlayingStrategy
     */
    private $wrapped;

    /**
     * @var int
     */
    private $playsLimit;

    /**
     * @var int
     */
    private $playsCount = 0;

    /**
     * @param PlayingStrategy $playingStrategy
     * @param int $playsLimit total plays limit
     */
    public function __construct(PlayingStrategy $playingStrategy, int $playsLimit)
    {
        $this->wrapped = $playingStrategy;
        $this->playsLimit = $playsLimit;
    }

    /**
     * @inheritDoc
     */
    public function playComposition(Playlist $playlist): ?Composition
    {
        if ($this->playsCount >= $this->playsLimit) {
            return null;
        }

        $next = $this->wrapped->playComposition($playlist);
        $this->playsCount++;

        return $next;
    }
}