<?php declare(strict_types=1);

namespace Club\MusicPlayer\PlayingStrategy;

use Club\Music\Composition;
use Club\Music\Playlist;

/**
 * Playing strategy interface
 */
interface PlayingStrategy
{
    /**
     * Play a composition from the track list. Returns the playing composition or NULL if there are no compositions to play.
     *
     * @param Playlist $playlist
     *
     * @return Composition|null
     */
    public function playComposition(Playlist $playlist): ?Composition;
}