<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectNearPlace extends Model
{
    protected $fillable = ['project_id', 'name', 'description', 'time', 'order'];
    
    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'time' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function translate(string $field): string
    {
        $locale = app()->getLocale();
        $value = $this->{$field};
        
        if (is_array($value)) {
            return $value[$locale] ?? $value['ar'] ?? $value['en'] ?? $value['zh'] ?? '';
        }
        
        return $value ?? '';
    }
}
