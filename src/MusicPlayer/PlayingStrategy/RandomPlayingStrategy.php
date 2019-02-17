<?php declare(strict_types=1);

namespace Club\MusicPlayer\PlayingStrategy;

use Club\Music\Composition;
use Club\Music\Playlist;

/**
 * Choose random tracks from playlist
 */
class RandomPlayingStrategy implements PlayingStrategy
{
    /**
     * @inheritDoc
     */
    public function playComposition(Playlist $playlist): ?Composition
    {
        $tracks = $playlist->toArray();
        if (!$tracks) {
            return null;
        }

        $random = array_rand($tracks);
        return $tracks[$random];
    }
}