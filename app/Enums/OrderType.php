<?php

namespace App\Enums;

interface OrderType
{
    const DELIVERY = 5;
    const PICK_UP = 10;
    const POS = 15;
    const CREDIT = 20;
    const DEPOSIT = 25;
    const TAKE_AWAY = 10;
}
