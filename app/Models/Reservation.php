<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'barber_id',
        'appointment_date',
        'start_time',
        'end_time',
        'status',
    ];

    // Get the user that made the appointment.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Get the barber associated with the appointment.
    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id');
    }
}
