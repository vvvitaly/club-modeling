<?php declare(strict_types=1);

namespace Club\Infrastructure;

/**
 * Visitable component
 */
interface Visitable
{
    /**
     * @param Visitor $visitor
     */
    public function accept(Visitor $visitor): void;
}