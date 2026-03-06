<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Patient;
use App\Models\PrescriptionItem;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'doctor_id', 'diagnosis', 'notes', 'prescription_date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class , 'doctor_id');
    }

    public function items()
    {
        return $this->hasMany(PrescriptionItem::class);
    }
}
