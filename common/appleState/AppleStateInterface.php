<?php

namespace common\appleState;

use common\models\Apple;

interface AppleStateInterface
{
    public function fall();

    public function eat();

    public function biteOff(int $percent, Apple $apple);

    public function rot(Apple $apple);

    public function canFall(Apple $apple): bool;

    public function canEat(Apple $apple): bool;

    public function canRot(Apple $apple): bool;

    public function canBiteOff(Apple $apple, int $percent): bool;
}
