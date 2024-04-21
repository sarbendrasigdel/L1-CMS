<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class UserPermission extends Model
{
    public function users(): MorphToMany
    {
        return $this->morphToMany();
    }
}
