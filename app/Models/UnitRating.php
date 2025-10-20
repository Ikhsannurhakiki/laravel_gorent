<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitRating extends Model
{
    use HasFactory;
    protected $with = ['user', 'unit'];
    protected $fillable = ['user_id', 'unit_id', 'stars', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
