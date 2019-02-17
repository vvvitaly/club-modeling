<?php declare(strict_types=1);

namespace Club\Dances\Styles\Movements;

use Club\Dances\Styles\DanceStyle;

/**
 * Load movements via MovementsFactory
 */
class LazyMovementsSequence implements MovementsSequence
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
        $this->dance = $dance;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return MovementsFactory::getMovementsSequence($this->dance)->toArray();
    }
}