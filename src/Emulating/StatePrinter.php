<?php declare(strict_types=1);

namespace Club\Emulating;

use Club\Club\Club;
use Club\Dances\Movements\BackAndForthWiggle;
use Club\Dances\Movements\BarelyMoving;
use Club\Dances\Movements\BodyPart;
use Club\Dances\Movements\HalfBentLimbs;
use Club\Dances\Movements\Movement;
use Club\Dances\Movements\RhythmMovement;
use Club\Dances\Movements\Rotating;
use Club\Dances\Movements\SmoothMotion;
use Club\Dances\Styles\DanceStyle;
use Club\Dances\Styles\ElectroDance;
use Club\Dances\Styles\HipHop;
use Club\Dances\Styles\House;
use Club\Dances\Styles\Movements\DanceMovement;
use Club\Dances\Styles\PopMusicDance;
use Club\Dances\Styles\Rnb;
use Club\Infrastructure\Visitor;
use Club\Music\Genre;
use Club\MusicPlayer\MusicPlayer;
use Club\MusicPlayer\PlayerStoppedException;
use Club\Persons\Person;
use Club\Persons\States\DancingState;
use Club\Persons\States\DrinkingState;
use Club\Persons\States\PersonState;
use Club\Persons\States\WaitingState;

/**
 * Class StatePrinter
 */
class StatePrinter implements Visitor
{
    /**
     * @var array
     */
    private static $genres;

    /**
     * @var array
     */
    private static $styles;

    /**
     * @var array
     */
    private static $bodyParts;

    /**
     * @var array
     */
    private static $movements;

    /**
     * @inheritDoc
     */
    public function visitClub(Club $club): void
    {
        $persons = $club->getPersons();

        echo 'Сейчас в клубе ' . iterator_count($persons) . ' человек(а)';

        $this->visitMusicPlayer($club->getMusicPlayer());
        foreach ($persons as $person) {
            $this->visitPerson($person);
        }
    }

    /**
     * @inheritDoc
     */
    public function visitMusicPlayer(MusicPlayer $musicPlayer): void
    {
        try {
            $currentMusic = $musicPlayer->getCurrentComposition();
        } catch (PlayerStoppedException $e) {
            $currentMusic = null;
        }

        if ($currentMusic) {
            $genre = self::getGenreText($currentMusic->getGenre());
            echo ', играет: ' . $currentMusic->getTitle() . " ({$genre})" . PHP_EOL;
        } else {
            echo ', пока что тихо...' . PHP_EOL;
        }
    }

    /**
     * @inheritDoc
     */
    public function visitPerson(Person $person): void
    {
        $gender = $person->getGender()->isMale() ? 'мальчик' : 'девочка';

        echo "   Посетитель {$person->getId()->getName()} ({$gender}) ";
        $this->visitPersonState($person->getState());
    }

    /**
     * @inheritDoc
     */
    public function visitPersonState(PersonState $personState): void
    {
        if ($personState instanceof WaitingState) {
            echo 'ждет...' . PHP_EOL;

            return ;
        }

        if ($personState instanceof DrinkingState) {
            echo 'ушел в бар пить водку' . PHP_EOL;

            return ;
        }

        if ($personState instanceof DancingState) {
            $dance = $personState->getDanceStyle();
            $danceName = self::getDanceText($dance);

            echo "танцует {$danceName}: ";
            foreach ($dance->getMovementsSequence()->toArray() as $movement) {
                $this->visitDancingMovement($movement);
            }
            echo PHP_EOL;
        }
    }

    /**
     * @inheritDoc
     */
    public function visitDancingMovement(DanceMovement $movement): void
    {
        $bodyPart = self::getBodyPartName($movement->getBodyPart());
        $movement = self::getMovementName($movement->getMovement());

        echo $bodyPart . ' - ' . $movement . '; ';
    }

    /**
     * @param Genre $genre
     *
     * @return string
     */
    private static function getGenreText(Genre $genre): string
    {
        if (!self::$genres) {
            self::$genres = [
                [Genre::popMusic(), 'Pop music'],
                [Genre::electroHouse(), 'Electrohouse'],
                [Genre::rnb(), 'RnB'],
            ];
        }

        foreach (self::$genres as [$knownGenre, $name]) {
            if ($knownGenre->isEquals($genre)) {
                return $name;
            }
        }

        return '';
    }

    /**
     * @param DanceStyle $style
     *
     * @return string
     */
    private static function getDanceText(DanceStyle $style): string
    {
        if (!self::$styles) {
            self::$styles = [
                HipHop::class => 'хип-хоп',
                Rnb::class => 'рнб',
                ElectroDance::class => 'Electrodance',
                House::class => 'house',
                PopMusicDance::class => 'под поп-музыку',
            ];
        }

        return (string)self::$styles[get_class($style)];
    }

    /**
     * @param BodyPart $bodyPart
     *
     * @return string
     */
    private static function getBodyPartName(BodyPart $bodyPart): string
    {
        if (!self::$bodyParts) {
            self::$bodyParts = [
                [BodyPart::body(), 'тело'],
                [BodyPart::arms(), 'руки'],
                [BodyPart::legs(), 'ноги'],
                [BodyPart::head(), 'голова'],
            ];
        }

        foreach (self::$bodyParts as [$knownPart, $name]) {
            if ($knownPart->isEquals($bodyPart)) {
                return $name;
            }
        }

        return '';
    }

    /**
     * @param Movement $movement
     *
     * @return string
     */
    private static function getMovementName(Movement $movement): string
    {
        if (!self::$movements) {
            self::$movements = [
                BackAndForthWiggle::class => 'вперед-назад',
                BarelyMoving::class => 'почти без движения',
                HalfBentLimbs::class => 'полусогнуты',
                RhythmMovement::class => 'движение в ритме',
                Rotating::class => 'вращение',
                SmoothMotion::class => 'плавные движения',
            ];
        }

        return (string)self::$movements[get_class($movement)];
    }
}