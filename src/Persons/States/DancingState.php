<?php declare(strict_types=1);

namespace Club\Persons\States;

use Club\Dances\Styles\DanceStyle;

/**
 * Dance
 */
class DancingState implements PersonState
{
    /**
     * @var DanceStyle
     */
    private $danceStyle;

    /**
     * DancingState constructor.
     *
     * @param DanceStyle $danceStyle
     */
    public function __construct(DanceStyle $danceStyle)
    {
        $this->danceStyle = $danceStyle;
    }

    /**
     * @return DanceStyle
     */
    public function getDanceStyle(): DanceStyle
    {
        return $this->danceStyle;
    }
}