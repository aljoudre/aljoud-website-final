<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Project extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $guarded = [];

    protected $casts = [
        'name' => 'array',
        'subtitle' => 'array',
        'location' => 'array',
        'type' => 'array',
        'status' => 'array',
        'header_description' => 'array',
        'description' => 'array',
        'owner' => 'array',
        'developer' => 'array',
        'contractor' => 'array',
        'additional_content' => 'array',
        'has_header_image' => 'boolean',
        'enable_3d_tour' => 'boolean',
        'polygon_coordinates' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }


    protected static function booted()
{
    static::creating(function ($model) {
        $model->uuid = (string) \Illuminate\Support\Str::uuid();
    });
}

    public function translate(string $field): string
    {
        $locale = app()->getLocale();
        return $this->{$field}[$locale] ?? $this->{$field}['ar'] ?? '';
    }

    /**
     * Register media collections.
     */
    public function features()
    {
        return $this->hasMany(ProjectFeature::class)->orderBy('order');
    }

    public function nearPlaces()
    {
        return $this->hasMany(ProjectNearPlace::class)->orderBy('order');
    }

    public function buttons()
    {
        return $this->hasMany(ProjectButton::class)->orderBy('order');
    }

    public function stats()
    {
        return $this->hasMany(ProjectStat::class)->orderBy('order');
    }

    /**
     * Get the disk name for media files.
     * This ensures all Project media is stored in public storage.
     */
    public function getMediaDiskName(): string
    {
        return 'public';
    }

    public function registerMediaCollections(): void
    {
        // Simple single-file collection (project image)
        $this->addMediaCollection('project_hero');
        $this->addMediaCollection('project_image')
            ->singleFile();
        // Multiple files collection (gallery)
        $this->addMediaCollection('project_gallery');
        $this->addMediaCollection('project_logo')
            ->singleFile();
        // 360 Tour media
        $this->addMediaCollection('tour_360')
            ->singleFile();
        // Header image (alternative to hero)
        $this->addMediaCollection('header_image')
            ->singleFile();
        // Owner/Developer/Contractor logos
        $this->addMediaCollection('owner_logo')
            ->singleFile();
        $this->addMediaCollection('developer_logo')
            ->singleFile();
        $this->addMediaCollection('contractor_logo')
            ->singleFile();
        // Marker logo (can be different from project logo)
        $this->addMediaCollection('marker_logo')
            ->singleFile();
    }
}
