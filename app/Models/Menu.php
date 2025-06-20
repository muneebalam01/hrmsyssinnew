<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['label', 'route', 'roles', 'order'];

    protected $casts = [
        'roles' => 'array', // converts JSON to array automatically
    ];
}
