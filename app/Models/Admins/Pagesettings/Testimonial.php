<?php

namespace App\Models\Admins\Pagesettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    public function scopeFilterByGlobalSearch($query, $searchKey)
    {
        if ($searchKey) {
            return $query->where(function($q) use ($searchKey) {
                $q->where('name', 'LIKE', "%{$searchKey}%")
                  ->orWhere('comapny', 'LIKE', "%{$searchKey}%")
                  ->orWhere('description', 'LIKE', "%{$searchKey}%");
            });
        }

        return $query;
    }
}
