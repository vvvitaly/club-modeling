<?php declare(strict_types=1);

namespace Club\Emulating;

use Club\Music\Playlist;
use Club\Persons\Person;

/**
 * Configuration
 */
class EmulatingConfiguration
{
    /**
     * @var Playlist
     */
    public $playlist;

    /**
     * @var int
     */
    public $musicTrackDurationSeconds = 5;

    /**
     * @var Person[]
     */
    public $initialVisitors = [];
}