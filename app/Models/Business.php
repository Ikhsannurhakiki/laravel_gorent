<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_id',
        'name',
        'address',
        'logo',
        'phone',
        'email',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
