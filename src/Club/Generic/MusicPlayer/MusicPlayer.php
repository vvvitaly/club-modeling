<?php declare(strict_types=1);

namespace Club\Club\Generic\MusicPlayer;

use Club\Club\NoMusicLoadedException;

/**
 * Club music player
 */
interface MusicPlayer
{
    /**
     * Start music playing
     *
     * @throws NoMusicLoadedException
     */
    public function startPlaying(): void;
}