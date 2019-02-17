<?php declare(strict_types=1);

namespace Club\Persons\States;

use Club\Infrastructure\Visitor;

/**
 * Do nothing, waiting changes
 */
class WaitingState implements PersonState
{
    use VisitableTrait;
}