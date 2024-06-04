<?php

namespace App\Models\Admins\Pagesettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioImage extends Model
{
    use HasFactory;
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class,'portfolio_id');
    }
    public function scopeFilterByGlobalSearch($query, $searchKey)
    {
        if ($searchKey) {
            return $query->where(function($q) use ($searchKey) {
                $q->where('portfolio_id', 'LIKE', "%{$searchKey}%");
                  
            });
        }

        return $query;
    }
}
