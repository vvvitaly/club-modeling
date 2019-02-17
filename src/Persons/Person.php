<?php declare(strict_types=1);

namespace Club\Persons;

use Club\Music\Composition;
use Club\MusicPlayer\MusicListener;

/**
 * Club visitor
 */
final class Person implements MusicListener
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
     * Person constructor.
     *
     * @param PersonId $id
     * @param Gender $gender
     */
    public function __construct(PersonId $id, Gender $gender)
    {
        $this->id = $id;
        $this->gender = $gender;
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
     * @inheritDoc
     */
    public function updateListeningComposition(Composition $composition): void
    {
        // TODO: Implement updateListeningComposition() method.
    }
}