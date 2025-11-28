<?php

namespace App\Models;

use App\Models\Business;
use Spatie\Tags\HasTags;
use App\Models\UnitRating;
use App\Models\UnitType; // Tambah ini
use Spatie\Image\Enums\Fit;
use Filament\Facades\Filament;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Unit extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasTags;

    protected $fillable = [
        'business_id',
        'type', // Ubah dari string menjadi foreign key
        'name',
        'description',
        'is_available',
        'location_name',
        'latitude',
        'longitude',
        // Hapus plate_number dan price_per_day karena tidak ada di struktur baru
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Eager loading
    protected $with = ['business', 'unitType'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('thumbnail')
            ->singleFile();

        $this
            ->addMediaCollection('gallery');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumbnail')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Filament::auth()->user();

        // If the user is an admin, show all
        if ($user->hasRole('admin')) {
            return parent::getEloquentQuery();
        }

        // Otherwise, show only units that belong to the user's businesses
        return parent::getEloquentQuery()
            ->whereHas('business', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
    }

    /**
     * Relationships
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    // Relationship dengan unit_types
    public function unitType()
    {
        return $this->belongsTo(UnitType::class, 'type'); // 'type' adalah foreign key
    }

    public function ratings()
    {
        return $this->hasMany(UnitRating::class);
    }

    /**
     * Attributes
     */
    protected function averageRating(): Attribute
    {
        return Attribute::get(
            fn() => round($this->ratings()->avg('stars') ?? 0, 1)
        );
    }

    protected function reviewCount(): Attribute
    {
        return Attribute::get(
            fn() => $this->ratings()->count()
        );
    }

    /**
     * Scope for available units
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    /**
     * Scope for units by location
     */
    public function scopeNearby($query, $latitude, $longitude, $radius = 10)
    {
        return $query->whereRaw("
            (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) < ?
        ", [$latitude, $longitude, $latitude, $radius]);
    }

    /**
     * Accessor for thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->getFirstMediaUrl('thumbnail') ?: asset('images/default-thumbnail.jpg');
    }

    /**
     * Check if unit has location data
     */
    public function hasLocation(): bool
    {
        return !is_null($this->latitude) && !is_null($this->longitude);
    }

    /**
     * Get full location address
     */
    public function getFullLocationAttribute(): string
    {
        if ($this->location_name && $this->hasLocation()) {
            return $this->location_name . " ({$this->latitude}, {$this->longitude})";
        }

        return $this->location_name ?: 'Location not set';
    }
}
