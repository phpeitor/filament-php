<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'meeting_date',
        'subject',
        'meeting_status',
        'details',
        'url',
        'minutes',
        'client_name',
        'client_email',
        'user_session', 
    ];

    protected $casts = [
        'meeting_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($meeting) {
            $meeting->user_session = auth()->id(); 
        });
    }
}
