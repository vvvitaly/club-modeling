<?php declare(strict_types=1);

namespace Club\Emulating;

use Club\Club\Club;
use Club\Club\Generic\FaceControl\AllowAllStrategy;
use Club\Club\Generic\GenericClub;
use Club\Club\NoEntryException;
use Club\Infrastructure\Visitor;
use Club\MusicPlayer\GenericMusicPlayer;
use Club\MusicPlayer\MusicPlayer;
use Club\MusicPlayer\PlayingStrategy\LimitPlaysCount;
use Club\MusicPlayer\PlayingStrategy\RandomPlayingStrategy;

/**
 * Emulator application
 */
final class Emulator
{
    /**
     * @var EmulatingConfiguration
     */
    private $configuration;

    /**
     * @var Visitor
     */
    private $visitor;

    /**
     * Emulator constructor.
     *
     * @param EmulatingConfiguration $configuration
     * @param Visitor $visitor
     */
    public function __construct(EmulatingConfiguration $configuration, Visitor $visitor)
    {
        $this->configuration = $configuration;
        $this->visitor = $visitor;
    }

    /**
     * Run emulation
     */
    public function run(): void
    {
        $musicPlayer = $this->createMusicPlayer();
        $club = $this->createClub($musicPlayer);

        $club->usePlaylist($this->configuration->playlist);

        foreach ($this->configuration->initialVisitors as $visitor) {
            try {
                $club->letPersonIn($visitor);
            } catch (NoEntryException $e) {
                echo "{$e->getPerson()->getId()->getName()} - no entry!" . PHP_EOL;
            }
        }

        $musicPlayer->addListener(new MusicListener($this->visitor, $club)); // re-visit after changing track
        $club->accept($this->visitor);
        $club->playMusic();
    }

    /**
     * @return MusicPlayer
     */
    private function createMusicPlayer(): MusicPlayer
    {
        $playingStrategy = new EmulatingPlayingTrackStrategy(
            new LimitPlaysCount(
                new RandomPlayingStrategy(),
                1000
            ),
            $this->configuration->musicTrackDurationSeconds
        );
        return new GenericMusicPlayer($playingStrategy);
    }

    /**
     * @param MusicPlayer $musicPlayer
     *
     * @return Club
     */
    private function createClub(MusicPlayer $musicPlayer): Club
    {
        $faceControl = new AllowAllStrategy();
        return new GenericClub($faceControl, $musicPlayer);
    }
}