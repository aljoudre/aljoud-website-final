<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Hero extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    protected $with = []; // Don't eager load relationships

    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
        'is_video' => 'boolean',
    ];


    protected static function booted()
    {
        static::creating(function ($model) {
            if (static::count() > 0) {
                return false; // prevent creating more than one
            }
        });
    }

    public function translate(string $field, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{$field}[$locale] ?? $this->{$field}['ar'] ?? $this->{$field}['en'] ?? '';
    }

    public function getMediaDiskName(): string
    {
        return 'public';
    }

    public function registerMediaCollections(): void
    {
        // Video for hero section (only one video needed)
        $this->addMediaCollection('video')->singleFile();
        // Image for hero section (only one image needed)
        $this->addMediaCollection('hero_image')->singleFile();
    }

    public function getHeroImageAttribute()
    {
        $media = $this->getFirstMedia('hero_image');
        return $media ? $media->getUrl() : asset('assets/images/logo.png');
    }

    public function getVideoAttribute()
    {
        $media = $this->getFirstMedia('video');
        return $media ? $media->getUrl() : null;
    }
}
