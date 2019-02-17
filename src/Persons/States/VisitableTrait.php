<?php declare(strict_types=1);

namespace Club\Persons\States;

use Club\Infrastructure\Visitor;

/**
 * Visitable implementation
 */
trait VisitableTrait
{
    /**
     * @inheritDoc
     */
    public function accept(Visitor $visitor): void
    {
        $visitor->visitPersonState($this);
    }
}