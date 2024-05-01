<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_name',
        'description',
        'duration',
        'price',
    ];
    //  Get the barber who owns the service.
    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id');
    }
}
