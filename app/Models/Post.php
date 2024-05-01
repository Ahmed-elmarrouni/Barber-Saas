<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'barber_id',
    ];

    // Get the barber that owns the post.
    public function barber()
    {
        return $this->belongsTo(Barber::class, 'barber_id');
    }
    public  function category()
    {
        return $this->belongsTo(Category::class);
    }
}
