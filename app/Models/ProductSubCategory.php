<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;

    /**
     *  subcategory belongs to category relationship.
     *
     * @return belongsTo(ProductCategory::class)
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'categories_id', 'id');
    }

    /**
     *  subcategory has many products relationship.
     *
     * @return hasMany(Product::class)
     */
    public function product()
    {
        return $this->hasMany(Product::class, 'sub_categories_id', 'id');
    }
}
