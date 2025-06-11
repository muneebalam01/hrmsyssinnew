<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        // return $this->hasMany(User::class);
        return $this->belongsToMany(User::class, 'role_user');
    }

/*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Get the modules associated with the role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

/*******  08896382-e6fc-41f2-bc88-59cae4c6d5e4  *******/
    public function modules()
{
    return $this->belongsToMany(Module::class, 'role_module');
}

}
