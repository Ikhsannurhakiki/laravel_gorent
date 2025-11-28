<?php

namespace App\Models;

use App\Models\Business;
use Spatie\Tags\HasTags;
use App\Models\UnitRating;
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

    protected $with = ['business']; //eager loading biar ga nambah query di view
    protected $fillable = [
        'business_id',
        'plate_number',
        'name',
        'type',
        'description',
        'price_per_day',
        'is_available',
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
