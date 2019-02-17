<?php declare(strict_types=1);

namespace Club\Music;

/**
 * Compositions collection
 */
final class Playlist
{
    /**
     * @var Composition[]
     */
    private $compositions = [];

    /**
     * Add the composition to playlist
     *
     * @param Composition $composition
     */
    public function addComposition(Composition $composition): void
    {
        $this->compositions[] = $composition;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->compositions;
    }
}