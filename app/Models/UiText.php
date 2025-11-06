<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UiText extends Model
{
    protected $fillable = ['key', 'value'];
    
    protected $casts = [
        'value' => 'array',
    ];

    public function translate(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        return $this->value[$locale] ?? $this->value['ar'] ?? $this->value['en'] ?? $this->key;
    }

    public static function getText(string $key, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $uiText = self::where('key', $key)->first();
        
        if ($uiText) {
            return $uiText->translate($locale);
        }
        
        return $key; // fallback to key if missing
    }
}
