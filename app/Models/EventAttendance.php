<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventAttendance extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_attendances';

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id',
        'user_id',
        'status',
    ];
}