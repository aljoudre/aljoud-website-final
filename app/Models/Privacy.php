<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'title' => 'array',
        'content' => 'array',
    ];

    public function translate(string $field): string
    {
        $locale = app()->getLocale();
        return $this->{$field}[$locale] ?? $this->{$field}['ar'] ?? '';
    }
}
