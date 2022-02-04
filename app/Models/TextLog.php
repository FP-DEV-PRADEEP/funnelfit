<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextLog extends Model
{
    use HasFactory;

    protected $fillable = ['to', 'message', 'status'];

    public function entity()
    {
        return $this->morphTo();
    }
}
