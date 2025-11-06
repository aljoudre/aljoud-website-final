<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProjectFeature extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['project_id', 'name', 'order'];
    
    protected $casts = [
        'name' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function translate(string $field): string
    {
        $locale = app()->getLocale();
        return $this->{$field}[$locale] ?? $this->{$field}['ar'] ?? '';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')
            ->singleFile();
    }
}
