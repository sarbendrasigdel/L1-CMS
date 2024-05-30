<?php

namespace App\Models\Admins\Pagesettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFeatures extends Model
{
    use HasFactory;

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }
    public function scopeFilterByGlobalSearch($query, $searchKey)
    {
        if ($searchKey) {
            return $query->where(function($q) use ($searchKey) {
                $q->where('title', 'LIKE', "%{$searchKey}%")
                  ->orWhere('description', 'LIKE', "%{$searchKey}%")
                  ->orWhere('service_id', 'LIKE', "%{$searchKey}%");
            });
        }

        return $query;
    }
}
