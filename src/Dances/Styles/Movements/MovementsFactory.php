<?php declare(strict_types=1);

namespace Club\Dances\Styles\Movements;

use Club\Dances\Styles\DanceStyle;
use Club\Dances\Styles\ElectroDance;
use Club\Dances\Styles\HipHop;
use Club\Dances\Styles\House;
use Club\Dances\Styles\PopMusicDance;
use Club\Dances\Styles\Rnb;

/**
 * Movements sequences factory
 */
class MovementsFactory
{
    /**
     * @var MovementsSequence[]
     */
    private static $movements;

    /**
     * @param DanceStyle $danceStyle
     *
     * @return MovementsSequence
     */
    public static function getMovementsSequence(DanceStyle $danceStyle): MovementsSequence
    {
        $class = get_class($danceStyle);
        if (!isset(self::$movements[$class])) {
            self::$movements[ElectroDance::class] = new ElectroDanceMovements();
            self::$movements[HipHop::class] = new HipHopMovements();
            self::$movements[House::class] = new ElectroDanceMovements();
            self::$movements[PopMusicDance::class] = new PopMusicDanceMovements();
            self::$movements[Rnb::class] = new HipHopMovements();
        }

        return self::$movements[$class];
    }
}