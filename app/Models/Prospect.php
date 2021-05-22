<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    protected $table = 'prospect';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
        'source',
        'date'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%');
            $query->orWhere('email', 'like', '%'.$search.'%');
            $query->orWhere('phone', 'like', '%'.$search.'%');
        })->when($filters['date'] ?? null, function ($query, $date) {
            $carbonDate = new Carbon($date);
            $query->whereDate('date', $carbonDate->format('Y-m-d') );
        })->when($filters['location'] ?? null, function ($query, $location) {
            $query->where('location', $location);
        });
    }
}
