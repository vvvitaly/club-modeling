<?php declare(strict_types=1);

namespace Club\Persons\States;

use Club\Infrastructure\Visitor;

/**
 * Go to the bar and drink vodka
 */
class DrinkingState implements PersonState
{
    use VisitableTrait;
}