<?php

namespace AppBundle\Entity;

use MyCLabs\Enum\Enum;

class State extends Enum
{
    const LOCKED = 1;
    const UNLOCKED = 2;

}