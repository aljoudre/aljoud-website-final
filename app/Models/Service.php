<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $guarded = [];
    
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    /**
     * Translate a field based on current locale.
     */
    public function translate(string $field): string
    {
        $locale = app()->getLocale();
        $value = $this->{$field};
        
        // Handle if value is still a string (old data or JSON string)
        if (is_string($value)) {
            // Try to decode if it's a JSON string (may be double-encoded)
            $decoded = json_decode($value, true);
            $attempts = 0;
            while (is_string($decoded) && json_last_error() === JSON_ERROR_NONE && $attempts < 3) {
                $decoded = json_decode($decoded, true);
                $attempts++;
            }
            
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $value = $decoded;
            } else {
                // If it's just a plain string, return it as-is
                return $value;
            }
        }
        
        // Handle array format
        if (is_array($value)) {
            // Check if the array values are also JSON strings (double-encoded case)
            if (isset($value[$locale]) && is_string($value[$locale])) {
                $decoded = json_decode($value[$locale], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    // Use the decoded value for the locale only (single language)
                    $result = $decoded[$locale] ?? $decoded['ar'] ?? $decoded['en'] ?? $decoded['zh'] ?? '';
                    // Clean up if it contains both languages separated by |
                    return preg_replace('/\s*\|.*$/', '', $result);
                }
            }
            $result = $value[$locale] ?? $value['ar'] ?? $value['en'] ?? $value['zh'] ?? '';
            // Clean up if it contains both languages separated by |
            return preg_replace('/\s*\|.*$/', '', $result);
        }
        
        return '';
    }

    /**
     * Register media collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icon')->singleFile();
    }
}
