<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'owner_id',
        'name',
        'address',
        'phone',
        'email',
        // 'description',
    ];

    /**
     * Define media collections
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->singleFile();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
