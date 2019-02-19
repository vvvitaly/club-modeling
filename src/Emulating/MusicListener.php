<?php declare(strict_types=1);

namespace Club\Emulating;

use Club\Club\Club;
use Club\Infrastructure\Visitor;
use Club\Music\Composition;

/**
 * Observer for music player
 */
class MusicListener implements \Club\MusicPlayer\MusicListener
{
    /**
     * @var Visitor
     */
    private $visitor;

    /**
     * @var Club
     */
    private $club;

    /**
     * @param Visitor $visitor
     * @param Club $club
     */
    public function __construct(Visitor $visitor, Club $club)
    {
        $this->visitor = $visitor;
        $this->club = $club;
    }

    /**
     * @inheritDoc
     */
    public function updateListeningComposition(Composition $composition): void
    {
        $this->club->accept($this->visitor);
    }
}