<?php

namespace App\Enums;

enum UserRole: string
{
    case PUBLISHER = 'publisher';
    case ATTENDEE = 'attendee';
    case ADMIN = 'admin';
}

