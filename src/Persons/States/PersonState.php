<?php declare(strict_types=1);

namespace Club\Persons\States;

use Club\Infrastructure\Visitable;
use Club\Persons\Person;

/**
 * Person state
 */
interface PersonState extends Visitable
{
    /**
     * Get owner
     *
     * @return Person
     */
    public function getPerson(): Person;
}