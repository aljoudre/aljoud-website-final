<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class About extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'content' => 'array',
        'header' => 'array',
    ];

  


    public function translate(string $field): string
    {
        $locale = app()->getLocale();
        return $this->{$field}[$locale] ?? $this->{$field}['ar'] ?? '';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')
        ->singleFile();
    }
}
