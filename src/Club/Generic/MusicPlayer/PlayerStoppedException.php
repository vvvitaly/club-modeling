<?php declare(strict_types=1);

namespace Club\Club\Generic\MusicPlayer;

/**
 * Error occurs when trying to get current composition and the player is not playing
 */
class PlayerStoppedException extends \DomainException
{
}