<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'city',
        'country',
        'phone',
        'email',
        'description',
        'star_rating',
        'latitude',
        'longitude',
        'geographical_location'
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}