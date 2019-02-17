<?php declare(strict_types=1);

namespace tests\MusicPlayer;

use Club\MusicPlayer\GenericMusicPlayer;
use Club\MusicPlayer\PlayingStrategy\PlayingStrategy;
use Club\Music\Composition;
use Club\Music\Genre;
use Club\Music\Playlist;
use PHPUnit\Framework\TestCase;

/**
 * Class GenericMusicPlayerTest
 */
class GenericMusicPlayerTest extends TestCase
{
    public function testStartPlaying(): void
    {
        $playlist = new Playlist();

        $playingStrategy = $this->createMock(PlayingStrategy::class);
        $playingStrategy->expects(self::exactly(3))
            ->method('playComposition')
            ->with(self::identicalTo($playlist))
            ->willReturnOnConsecutiveCalls(
                new Composition('song 1', Genre::rnb()),
                new Composition('song 2', Genre::popMusic()),
                null
            );

        $player = new GenericMusicPlayer($playlist, $playingStrategy);

        $player->startPlaying();
    }
}