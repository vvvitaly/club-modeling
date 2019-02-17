<?php declare(strict_types=1);

namespace Club\MusicPlayer;

use Club\Music\Composition;

/**
 * Some music listener
 */
interface MusicListener
{
    /**
     * Update listener state when composition changes
     *
     * @param Composition $composition
     */
    public function updateListeningComposition(Composition $composition): void;
}