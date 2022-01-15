<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    /**
     *  OrderDetails belongs to user_order relationship.
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsTo
     */
    public function user_order()
    {
        return $this->belongsTo(UserOrder::class, 'user_order_id', 'id');
    }

     /**
     *  OrderDetails belongs to user_order relationship.
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
