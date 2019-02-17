<?php declare(strict_types=1);

namespace Club\Club;

use Club\Persons\Person;
use Throwable;

/**
 * No entry for the person
 */
class NoEntryException extends \DomainException
{
    /**
     * @var Person
     */
    private $person;

    /**
     * @inheritDoc
     */
    public function __construct(Person $person, string $message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->person = $person;
    }

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }
}