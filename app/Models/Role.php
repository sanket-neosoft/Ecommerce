<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

     /**
     *  Role has many users relationship.
     *
     * @return hasMany(User::class)
     */
    public function user() {
        return $this->hasMany(User::class, 'role_id', 'role_id');
    }
}
