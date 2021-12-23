<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendly extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time', 'end_time', 'event_uuid', 'event_type_uuid', 'url_slug', 'prospect_id',
    ];
}
