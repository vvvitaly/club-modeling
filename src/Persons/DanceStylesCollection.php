<?php declare(strict_types=1);

namespace Club\Persons;

use Club\Dances\Styles\DanceStyle;
use Club\Music\Genre;

/**
 * Styles set
 */
final class DanceStylesCollection
{
    /**
     * @var DanceStyle[]
     */
    private $styles;

    /**
     * StylesCollection constructor.
     *
     * @param DanceStyle ...$styles
     */
    public function __construct(DanceStyle ...$styles)
    {
        $this->styles = $styles;
    }

    /**
     * Get the corresponding dance style for the given music genre
     *
     * @param Genre $genre
     *
     * @return DanceStyle|null
     */
    public function getDanceForMusic(Genre $genre): ?DanceStyle
    {
        foreach ($this->styles as $danceStyle) {
            if ($danceStyle->canDanceToMusic($genre)) {
                return $danceStyle;
            }
        }

        return null;
    }
}