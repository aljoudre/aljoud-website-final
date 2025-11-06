<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectButton extends Model
{
    protected $fillable = ['project_id', 'title', 'type', 'url', 'form_url', 'order'];
    
    protected $casts = [
        'title' => 'array',
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
}
