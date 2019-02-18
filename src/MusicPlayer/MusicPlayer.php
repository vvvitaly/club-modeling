<?php declare(strict_types=1);

namespace Club\MusicPlayer;

use Club\Infrastructure\Visitable;
use Club\Music\Composition;
use Club\Music\Playlist;

/**
 * Club music player
 */
interface MusicPlayer extends Visitable
{
    /**
     * Start music playing
     *
     * @param Playlist $playlist
     */
    public function startPlaying(Playlist $playlist): void;

    /**
     * Get current playing composition
     *
     * @return Composition
     * @throws PlayerStoppedException
     */
    public function getCurrentComposition(): Composition;

    /**
     * Add new music listener
     *
     * @param MusicListener $listener
     *
     * @return void
     */
    public function addListener(MusicListener $listener): void;
}