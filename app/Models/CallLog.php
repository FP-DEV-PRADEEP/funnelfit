<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner',
        'zoho_id',
        'subject',
        'created_time',
        'modified_time',
        'modified_by',
        'call_duration_sec',
        'call_duration',
        'lead_name',
        'call_direction',
        'caller_type',
        'call_start_time',
        'created_by_name',
        'modified_by_name',
        'email',
    ];
}
