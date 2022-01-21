<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Calendly extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'start_time', 'end_time', 'event_uuid', 'event_type_uuid', 'url_slug', 'prospect_id',
    ];

    public function gymStaff()
    {
        return $this->belongsTo(GymStaff::class, 'event_uuid', 'event_uuid');
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();
        $array['start_time_timestamp'] = $this->start_time->getTimestamp();
        $array['end_time_timestamp'] = $this->end_time->getTimestamp();
        $array['created_at_timestamp'] = strtotime($this->created_at);
        $array['updated_at_timestamp'] = strtotime($this->updated_at);
        $array['employee_name'] = $this->gymStaff->name;
        $array['employee_phone'] = $this->gymStaff->phone;
        $array['gym_name'] = $this->gymStaff->gymLocation->name;

        return $array;
    }
}
