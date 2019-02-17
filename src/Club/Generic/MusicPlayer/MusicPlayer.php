<?php declare(strict_types=1);

namespace Club\Club\Generic\MusicPlayer;

use Club\Music\Composition;

/**
 * Club music player
 */
interface MusicPlayer
{
    /**
     * Start music playing
     */
    public function startPlaying(): void;

    /**
     * Get current playing composition
     *
     * @return Composition
     * @throws PlayerStoppedException
     */
    public function getCurrentComposition(): Composition;
}