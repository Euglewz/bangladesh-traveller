<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'location', 'description'];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}