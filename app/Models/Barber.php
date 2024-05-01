<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'location',
        'pictures',
        'working_hours',
        'rating',
    ];
    //  Get the user that owns the barber.
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    //  Get the reservation for the barber.
    public function reservation()
    {
        return $this->hasMany(Reservation::class, 'barber_id');
    }
}
