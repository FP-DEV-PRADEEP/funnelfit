<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymLocation extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function gymStaffs()
    {
        return $this->hasMany(GymStaff::class);
    }

    protected $appends = ['resource_url'];

    public function getResourceUrlAttribute()
    {
        return url('/admin/gym-locations/'.$this->getKey());
    }
}
