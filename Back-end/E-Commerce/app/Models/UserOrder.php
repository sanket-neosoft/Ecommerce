<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    use HasFactory;

    /**
     *  UserOrder belongs to User relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

     /**
     *  UserOrder has many to order details relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'user_order_id', 'id');
    }
}
