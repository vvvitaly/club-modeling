<?php declare(strict_types=1);

namespace Club\Dances\Styles\Movements;

use Club\Dances\Movements\BodyPart;
use Club\Dances\Movements\Movement;
use Club\Infrastructure\Visitable;
use Club\Infrastructure\Visitor;

/**
 * Body part movement
 */
final class DanceMovement implements Visitable
{
    /**
     * @var BodyPart
     */
    private $bodyPart;

    /**
     * @var Movement
     */
    private $movement;

    /**
     * @param BodyPart $bodyPart
     * @param Movement $movement
     */
    public function __construct(BodyPart $bodyPart, Movement $movement)
    {
        $this->bodyPart = $bodyPart;
        $this->movement = $movement;
    }

    /**
     * @return BodyPart
     */
    public function getBodyPart(): BodyPart
    {
        return $this->bodyPart;
    }

    /**
     * @return Movement
     */
    public function getMovement(): Movement
    {
        return $this->movement;
    }

    /**
     * @inheritDoc
     */
    public function accept(Visitor $visitor): void
    {
        $visitor->visitDancingMovement($this);
    }
}