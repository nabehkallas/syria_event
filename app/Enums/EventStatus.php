<?php

namespace App\Enums;

enum EventStatus: string
{
    case PENDING = 'pending';
    case PUBLISHED = 'published';
    case CANCELED = 'canceled';
}

