<?php declare(strict_types=1);

namespace tests\Club\Generic;

use Club\Club\Generic\FaceControl\FaceControlStrategy;
use Club\Club\Generic\GenericClub;
use Club\Club\NoEntryException;
use Club\Music\Playlist;
use Club\MusicPlayer\MusicPlayer;
use Club\Persons\DanceStylesCollection;
use Club\Persons\Gender;
use Club\Persons\Person;
use Club\Persons\PersonId;
use PHPUnit\Framework\TestCase;

class GenericClubTest extends TestCase
{
    public function testLetPersonIn(): void
    {
        $person = new Person(new PersonId('test'), Gender::male(), new DanceStylesCollection());

        $faceControl = $this->createMock(FaceControlStrategy::class);
        $faceControl->expects(self::once())
            ->method('canLetPersonIn')
            ->with(self::identicalTo($person))
            ->willReturn(true);

        $musicPlayer = $this->createMock(MusicPlayer::class);
        $musicPlayer->expects(self::once())
            ->method('addListener')
            ->with(self::identicalTo($person));

        $club = new GenericClub($faceControl, $musicPlayer);

        $club->letPersonIn($person);
    }

    public function testLetPersonInWneNoEntry(): void
    {
        $musicPlayer = $this->createMock(MusicPlayer::class);

        $person = new Person(new PersonId('test'), Gender::male(), new DanceStylesCollection());

        $faceControl = $this->createMock(FaceControlStrategy::class);
        $faceControl->expects(self::once())
            ->method('canLetPersonIn')
            ->with(self::identicalTo($person))
            ->willReturn(false);

        $musicPlayer->expects(self::never())
            ->method('addListener');

        $club = new GenericClub($faceControl, $musicPlayer);

        $this->expectException(NoEntryException::class);
        $club->letPersonIn($person);
    }

    public function testPlayMusic(): void
    {
        $faceControl = $this->createMock(FaceControlStrategy::class);

        $playlist = new Playlist();

        $musicPlayer = $this->createMock(MusicPlayer::class);
        $musicPlayer->expects(self::once())
            ->method('startPlaying')
            ->with(self::identicalTo($playlist));

        $club = new GenericClub($faceControl, $musicPlayer);
        $club->usePlaylist($playlist);

        $club->playMusic();
    }
}