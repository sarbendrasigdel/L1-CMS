<?php

namespace App\Models\Admins\Pagesettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(category::class,'category_id');
    }
    public function scopeFilterByGlobalSearch($query, $searchKey)
    {
        if ($searchKey) {
            return $query->where(function($q) use ($searchKey) {
                $q->where('title', 'LIKE', "%{$searchKey}%")
                  ->orWhere('description', 'LIKE', "%{$searchKey}%")
                  ->orWhere('category_id', 'LIKE', "%{$searchKey}%");
            });
        }

        return $query;
    }
}
