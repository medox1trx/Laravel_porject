<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',   // FK vers User
        'phone',
        'address',
        'birthdate',
    ];

    // Un patient appartient à un User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un patient peut avoir plusieurs rendez-vous
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}