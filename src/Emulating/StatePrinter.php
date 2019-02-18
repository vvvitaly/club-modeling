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
use League\CLImate\CLImate;

/**
 * Class StatePrinter
 */
class StatePrinter implements Visitor
{
    /**
     * @var CLImate
     */
    private $cli;

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
     * StatePrinter constructor.
     *
     * @param CLImate $cli
     */
    public function __construct(CLImate $cli)
    {
        $this->cli = $cli;
    }

    /**
     * @inheritDoc
     */
    public function visitClub(Club $club): void
    {
        $persons = $club->getPersons();

        $this->cli->inline('Сейчас в клубе <bold>' . iterator_count($persons) . '</bold> человек(а)');

        $this->visitMusicPlayer($club->getMusicPlayer());
        foreach ($persons as $person) {
            $this->visitPerson($person);
        }
        $this->cli->out('');
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
            $this->cli->out(', играет: <green>' . $currentMusic->getTitle() . "</green> (<bold>{$genre}</bold>)");
        } else {
            $this->cli->out(', <whisper>пока что тихо...</whisper>');
        }
    }

    /**
     * @inheritDoc
     */
    public function visitPerson(Person $person): void
    {
        $this->cli->inline("   <bold>{$person->getId()->getName()}</bold>");
        if ($person->getState() instanceof WaitingState) {
            $gender = $person->getGender()->isMale() ? '<light_blue>♂</light_blue>' : '<light_red>♀</light_red>';

            $dances = $person->getDancesStyles()->toArray();
            $dances = array_map(
                function (DanceStyle $style) {
                    return self::getDanceText($style);
                },
                $dances
            );
            $dances = implode(',', $dances);

            $this->cli->inline("({$gender}, может танцевать <dim>{$dances}</dim>)");
        }
        $this->cli->inline(' ');
        $this->visitPersonState($person->getState());
    }

    /**
     * @inheritDoc
     */
    public function visitPersonState(PersonState $personState): void
    {
        if ($personState instanceof WaitingState) {
            $this->cli->out('<whisper>ждет...</whisper>');

            return ;
        }

        if ($personState instanceof DrinkingState) {
            $verb = $personState->getPerson()->getGender()->isMale() ? 'ушел' : 'ушла';
            $this->cli->out("<whisper>{$verb} в бар пить водку</whisper>");

            return ;
        }

        if ($personState instanceof DancingState) {
            $dance = $personState->getDanceStyle();
            $danceName = self::getDanceText($dance);

            $this->cli->inline("танцует <bold>{$danceName}</bold>: ");
            foreach ($dance->getMovementsSequence()->toArray() as $movement) {
                $this->visitDancingMovement($movement);
            }
            $this->cli->out('');
        }
    }

    /**
     * @inheritDoc
     */
    public function visitDancingMovement(DanceMovement $movement): void
    {
        $bodyPart = self::getBodyPartName($movement->getBodyPart());
        $movement = self::getMovementName($movement->getMovement());

        $this->cli->inline("<underline>{$bodyPart}</underline> - {$movement}; ");
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