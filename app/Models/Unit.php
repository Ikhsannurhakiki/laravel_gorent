<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
    protected $with = ['business']; //eager loading biar ga nambah query di view
    protected $fillable = [
        'business_id',
        'name',
        'type',
        'description',
        'price_per_day',
        'is_available',
        'thumbnail',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function ratings()
    {
        return $this->hasMany(UnitRating::class);
    }

    protected function averageRating(): Attribute
    {
        return Attribute::get(
            fn() =>
            round($this->ratings()->avg('stars') ?? 0, 1)
        );
    }

    protected function reviewCount(): Attribute
    {
        return Attribute::get(
            fn() =>
            $this->ratings()->count()
        );
    }
}
