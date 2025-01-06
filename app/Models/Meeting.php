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
    ];

    protected $casts = [
        'meeting_date' => 'datetime',
        'miniutes' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
