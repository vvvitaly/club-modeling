<?php declare(strict_types=1);

namespace tests\Persons;

use Club\Dances\Styles\DanceStyle;
use Club\Music\Composition;
use Club\Music\Genre;
use Club\Persons\DanceStylesCollection;
use Club\Persons\Gender;
use Club\Persons\Person;
use Club\Persons\PersonId;
use Club\Persons\States\DancingState;
use Club\Persons\States\DrinkingState;
use PHPUnit\Framework\TestCase;

/**
 * Class PersonTest
 */
class PersonTest extends TestCase
{
    public function testUpdateListeningCompositionShouldChangeToDancingState(): void
    {
        $dance = $this->createMock(DanceStyle::class);
        $dance->method('canDanceToMusic')->willReturn(true);

        $person = new Person(
            new PersonId('test'),
            Gender::male(),
            new DanceStylesCollection($dance)
        );

        $music = new Composition('test music', Genre::rnb());

        $person->updateListeningComposition($music);

        $actualState = $person->getState();

        self::assertInstanceOf(DancingState::class, $actualState);
        self::assertSame($dance, $actualState->getDanceStyle());
    }

    public function testUpdateListeningCompositionShouldChangeToDrinkingState(): void
    {
        $dance = $this->createMock(DanceStyle::class);
        $dance->method('canDanceToMusic')->willReturn(false);

        $person = new Person(
            new PersonId('test'),
            Gender::male(),
            new DanceStylesCollection($dance)
        );

        $music = new Composition('test music', Genre::rnb());

        $person->updateListeningComposition($music);

        $actualState = $person->getState();

        self::assertInstanceOf(DrinkingState::class, $actualState);
    }
}