<?php declare(strict_types=1);

namespace tests\MusicPlayer;

use Club\MusicPlayer\GenericMusicPlayer;
use Club\MusicPlayer\MusicListener;
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

        $player = new GenericMusicPlayer($playingStrategy);

        $player->startPlaying($playlist);
    }

    public function testStartPlayingShouldNotifyListeners(): void
    {
        $playlist = new Playlist();
        $current = new Composition('some song', Genre::popMusic());

        $playingStrategy = $this->createMock(PlayingStrategy::class);
        $playingStrategy->method('playComposition')->willReturnOnConsecutiveCalls($current, null);

        $listener1 = $this->createMock(MusicListener::class);
        $listener1->expects(self::once())
            ->method('updateListeningComposition')
            ->with(self::identicalTo($current));

        $listener2 = $this->createMock(MusicListener::class);
        $listener2->expects(self::once())
            ->method('updateListeningComposition')
            ->with(self::identicalTo($current));

        $player = new GenericMusicPlayer($playingStrategy);

        $player->addListener($listener1);
        $player->addListener($listener2);

        $player->startPlaying($playlist);
    }
}