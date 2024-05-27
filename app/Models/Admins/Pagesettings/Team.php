<?php

namespace App\Models\Admins\Pagesettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Team extends Model
{
    use HasFactory;
    public function scopeFilterByGlobalSearch($query, $searchKey)
    {
        if ($searchKey) {
            return $query->where(function($q) use ($searchKey) {
                $q->where('name', 'LIKE', "%{$searchKey}%")
                  ->orWhere('position', 'LIKE', "%{$searchKey}%")
                  ->orWhere('facebook', 'LIKE', "%{$searchKey}%")
                  ->orWhere('instagram', 'LIKE', "%{$searchKey}%")
                  ->orWhere('twitter', 'LIKE', "%{$searchKey}%")
                  ->orWhere('github', 'LIKE', "%{$searchKey}%");
            });
        }

        return $query;
    }
}
