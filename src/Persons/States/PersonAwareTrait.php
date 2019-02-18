<?php declare(strict_types=1);

namespace Club\Persons\States;

use Club\Persons\Person;

/**
 * Trait PersonAwareTrait
 */
trait PersonAwareTrait
{
    /**
     * @var Person
     */
    private $person;

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @param Person $person
     */
    public function setPerson(Person $person): void
    {
        $this->person = $person;
    }
}