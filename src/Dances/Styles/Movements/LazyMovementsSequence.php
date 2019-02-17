<?php declare(strict_types=1);

namespace Club\Dances\Styles\Movements;

use Club\Dances\Styles\DanceStyle;

/**
 * Load movements via MovementsFactory
 */
class LazyMovementsSequence extends MovementsSequence
{
    /**
     * @var DanceStyle
     */
    private $dance;

    /**
     * LazyMovementsSequence constructor.
     *
     * @param DanceStyle $dance
     */
    public function __construct(DanceStyle $dance)
    {
        parent::__construct();

        $this->dance = $dance;
    }
}