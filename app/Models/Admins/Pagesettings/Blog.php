<?php

namespace App\Models\Admins\Pagesettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Blog extends Model
{
    use HasFactory,HasSlug;
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function scopeFilterByGlobalSearch($query, $searchKey)
    {
        
        if ($searchKey) {
            return $query->where(function($q) use ($searchKey) {
                $q->where('title', 'LIKE', "%{$searchKey}%")
                  ->orWhere('category', 'LIKE', "%{$searchKey}%")
                  ->orWhere('description', 'LIKE', "%{$searchKey}%");
            });
        }

        return $query;
    }
}
