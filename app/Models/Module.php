<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['label', 'route'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_module');
    }
}
