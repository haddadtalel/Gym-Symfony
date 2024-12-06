<?php

namespace App\Type;

enum PackTypeEnum: string
{
    case basic = 'Basic';
    case premium = 'Premium';
    case vip = 'VIP';
    case YEARLY = 'Yearly';
    case MONTHLY = 'Monthly';
}