<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\MediaRepository;

class Hero extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];
    
    protected $with = []; // Don't eager load relationships
    
    protected $casts = [
        'title' => 'array',
        'subtitle' => 'array',
    ];
    
    public function translate(string $field, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->{$field}[$locale] ?? $this->{$field}['ar'] ?? $this->{$field}['en'] ?? '';
    }

    /**
     * Get the disk name for media files.
     * This ensures all Hero media is stored in public storage.
     */
    public function getMediaDiskName(): string
    {
        return 'public';
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        // Define your media collections here, e.g.:
        // $this->addMediaCollection('hero_image')->singleFile();
        $this->addMediaCollection('video')
        ->singleFile(); // only one hero video at a time
    }

    /**
     * Override loadMedia to prevent errors with corrupted data
     */
    public function loadMedia(string $collectionName): \Illuminate\Support\Collection
    {
        try {
            return parent::loadMedia($collectionName);
        } catch (\TypeError $e) {
            // If there's corrupted media data, return empty collection
            return collect([]);
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    /**
     * Override getMedia to prevent errors with corrupted data
     */
    public function getMedia(string $collectionName = 'default', array|callable $filters = []): \Illuminate\Support\Collection
    {
        try {
            return parent::getMedia($collectionName, $filters);
        } catch (\TypeError $e) {
            // If there's corrupted media data, return empty collection
            return collect([]);
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    /**
     * Override getFirstMedia to prevent errors
     */
    public function getFirstMedia(string $collectionName = 'default', array|callable $filters = []): ?\Spatie\MediaLibrary\MediaCollections\Models\Media
    {
        try {
            return parent::getFirstMedia($collectionName, $filters);
        } catch (\TypeError $e) {
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }
}
