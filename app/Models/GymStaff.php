<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'clubready_owner_id', 'event_uuid', 'gym_staff_type_id', 'gym_location_id'
    ];

    public function gymStaffType() {
        return $this->belongsTo(GymStaffType::class);
    }

    public function gymLocation() {
        return $this->belongsTo(GymLocation::class);
    }

    protected $appends = ['resource_url'];

    public function getResourceUrlAttribute()
    {
        return url('/admin/gym-staffs/'.$this->getKey());
    }
}
