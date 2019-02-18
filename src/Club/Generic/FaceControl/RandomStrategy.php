<?php declare(strict_types=1);

namespace Club\Club\Generic\FaceControl;

use Club\Persons\Person;
use InvalidArgumentException;

/**
 * Allow to enter randomly
 */
class RandomStrategy implements FaceControlStrategy
{
    /**
     * @var int
     */
    private $enterChance;

    /**
     * RandomStrategy constructor.
     *
     * @param int $enterChance
     *
     * @throws InvalidArgumentException
     */
    public function __construct(int $enterChance)
    {
        if ($enterChance <= 0 || $enterChance > 100) {
            throw new InvalidArgumentException("{$enterChance} is incorrect chance: it should be a positive number in interval [0; 100)");
        }

        $this->enterChance = $enterChance;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function canLetPersonIn(Person $person): bool
    {
        return random_int(0, 100) <= $this->enterChance;
    }
}