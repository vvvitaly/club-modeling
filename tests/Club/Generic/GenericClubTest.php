<?php declare(strict_types=1);

namespace tests\Club\Generic;

use Club\Club\Generic\DanceFloor\DanceFloor;
use Club\Club\Generic\FaceControl\FaceControlStrategy;
use Club\Club\Generic\GenericClub;
use Club\Club\Generic\MusicPlayer\MusicPlayer;
use Club\Club\NoEntryException;
use Club\Club\NoMusicLoadedException;
use Club\Persons\Gender;
use Club\Persons\Person;
use Club\Persons\PersonId;
use Club\Persons\StylesCollection;
use PHPUnit\Framework\TestCase;

/**
 * Class GenericClubTest
 */
class GenericClubTest extends TestCase
{
    public function testLetPersonIn(): void
    {
        $musicPlayer = $this->createMock(MusicPlayer::class);

        $person = new Person(new PersonId('test'), Gender::male());

        $faceControl = $this->createMock(FaceControlStrategy::class);
        $faceControl->expects(self::once())
            ->method('canLetPersonIn')
            ->with(self::identicalTo($person))
            ->willReturn(true);

        $danceFloor = $this->createMock(DanceFloor::class);
        $danceFloor->expects(self::once())
            ->method('letPersonIn')
            ->with(self::identicalTo($person));

        $club = new GenericClub($faceControl, $danceFloor, $musicPlayer);

        $club->letPersonIn($person);
    }

    public function testLetPersonInWneNoEntry(): void
    {
        $musicPlayer = $this->createMock(MusicPlayer::class);

        $person = new Person(new PersonId('test'), Gender::male());

        $faceControl = $this->createMock(FaceControlStrategy::class);
        $faceControl->expects(self::once())
            ->method('canLetPersonIn')
            ->with(self::identicalTo($person))
            ->willReturn(false);

        $danceFloor = $this->createMock(DanceFloor::class);
        $danceFloor->expects(self::never())
            ->method('letPersonIn');

        $club = new GenericClub($faceControl, $danceFloor, $musicPlayer);

        $this->expectException(NoEntryException::class);
        $club->letPersonIn($person);
    }

    public function testPlayMusic(): void
    {
        $faceControl = $this->createMock(FaceControlStrategy::class);
        $danceFloor = $this->createMock(DanceFloor::class);

        $musicPlayer = $this->createMock(MusicPlayer::class);
        $musicPlayer->expects(self::once())
            ->method('startPlaying');

        $club = new GenericClub($faceControl, $danceFloor, $musicPlayer);

        $club->playMusic();
    }

    public function testPlayMusicWhenNoMusic(): void
    {
        $faceControl = $this->createMock(FaceControlStrategy::class);
        $danceFloor = $this->createMock(DanceFloor::class);

        $musicPlayer = $this->createMock(MusicPlayer::class);
        $musicPlayer->expects(self::once())
            ->method('startPlaying')
            ->willThrowException(new NoMusicLoadedException('test'));

        $club = new GenericClub($faceControl, $danceFloor, $musicPlayer);

        $this->expectException(NoMusicLoadedException::class);
        $club->playMusic();
    }
}