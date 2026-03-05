<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',    // FK vers User
        'message',
        'read',       // booléen pour marquer lu/non-lu
    ];

    // Une notification appartient à un User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}