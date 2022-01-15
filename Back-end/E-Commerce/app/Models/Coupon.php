<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     *  Categories belongs to many Products relationship.
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsToMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class, 'coupon_useds', 'user_id', 'coupon_id');
    }
}
