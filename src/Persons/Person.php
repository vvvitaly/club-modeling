<?php declare(strict_types=1);

namespace Club\Persons;

use Club\Infrastructure\Visitable;
use Club\Infrastructure\Visitor;
use Club\Music\Composition;
use Club\MusicPlayer\MusicListener;
use Club\Persons\States\DancingState;
use Club\Persons\States\DrinkingState;
use Club\Persons\States\PersonState;
use Club\Persons\States\WaitingState;

/**
 * Club visitor
 */
final class Person implements MusicListener, Visitable
{
    /**
     * @var PersonId
     */
    private $id;

    /**
     * @var Gender
     */
    private $gender;

    /**
     * @var PersonState
     */
    private $state;

    /**
     * @var DanceStylesCollection
     */
    private $dances;

    /**
     * Person constructor.
     *
     * @param PersonId $id
     * @param Gender $gender
     * @param DanceStylesCollection $dances
     */
    public function __construct(PersonId $id, Gender $gender, DanceStylesCollection $dances)
    {
        $this->id = $id;
        $this->gender = $gender;
        $this->dances = $dances;

        $this->state = new WaitingState();
    }

    /**
     * @return PersonId
     */
    public function getId(): PersonId
    {
        return $this->id;
    }

    /**
     * @return Gender
     */
    public function getGender(): Gender
    {
        return $this->gender;
    }

    /**
     * @return DanceStylesCollection
     */
    public function getDancesStyles(): DanceStylesCollection
    {
        return $this->dances;
    }

    /**
     * @inheritDoc
     */
    public function updateListeningComposition(Composition $composition): void
    {
        $dance = $this->dances->getDanceForMusic($composition->getGenre());
        if ($dance) {
            $this->state = new DancingState($dance);
        } else {
            $this->state = new DrinkingState();
        }
    }

    /**
     * @return PersonState
     */
    public function getState(): PersonState
    {
        return $this->state;
    }

    /**
     * @inheritDoc
     */
    public function accept(Visitor $visitor): void
    {
        $visitor->visitPerson($this);
    }
}