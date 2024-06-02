<?php

namespace App\Models\Admins\Pagesettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
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
