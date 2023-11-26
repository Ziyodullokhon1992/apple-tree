<?php

namespace common\appleState;

use common\models\Apple;

abstract class AbstractAppleState implements AppleStateInterface
{
    /**
     * @throws IllegalStateTransitionException
     */
    public function fall()
    {
        throw new IllegalStateTransitionException();
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function eat()
    {
        throw new IllegalStateTransitionException("You can't eat an apple while it's still on the tree");
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function biteOff(int $percent, Apple $apple)
    {
        throw new IllegalStateTransitionException("You can't take a bite of an apple while it's still on the tree");
    }

    /**
     * @throws IllegalStateTransitionException
     */
    public function rot(Apple $apple)
    {
        throw new IllegalStateTransitionException();
    }

    public function canFall(Apple $apple): bool
    {
        return $apple->status == Apple::STATUS["ON_TREE"];
    }

    public function canEat(Apple $apple): bool
    {
        return in_array($apple->status, [Apple::STATUS["FALLEN"], Apple::STATUS["BITTEN_OFF"]]);
    }

    public function canRot(Apple $apple): bool
    {
        return time() - $apple->fallen_date >= 5 * 60 * 60;
    }

    public function canBiteOff(Apple $apple, int $percent): bool
    {
        return $apple->remained * 100 < $percent;
    }
}
