<?php

namespace App\Models;

use App\Jobs\SendProspectSMS;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    protected $table = 'prospect';

    protected $fillable = [
        'date',
        "prospect_owner",
        "prospect_id",
        "modified_by",
        "prospect_phone",
        "prospect_email",
        "prospect_mobile",
        "prospect_gym",
        "prospect_city",
        "prospect_state",
        "created_by_name",
        "modified_by_name",
        "prospect_first_name",
        "prospect_last_name",
        "prospect_source",
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('prospect_first_name', 'like', '%'.$search.'%');
            $query->orWhere('prospect_last_name', 'like', '%'.$search.'%');
            $query->orWhere('prospect_email', 'like', '%'.$search.'%');
            $query->orWhere('prospect_phone', 'like', '%'.$search.'%');
        })->when($filters['date'] ?? null, function ($query, $date) {
            $carbonDate = new Carbon($date);
            $query->whereDate('date', $carbonDate->format('Y-m-d') );
        })->when($filters['gym'] ?? null, function ($query, $gym) {
            $query->where('prospect_gym', $gym);
        });
    }

    public function text_logs()
    {
        return $this->morphMany(TextLog::class, 'entity');
    }

    protected static function booted()
    {
        static::created(function ($prospect) {
            // send prospec sms when created
            SendProspectSMS::dispatch($prospect);
        });
    }
}
