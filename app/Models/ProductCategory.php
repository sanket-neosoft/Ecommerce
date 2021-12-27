<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    /**
     *  category has many subcategory relationship.
     *
     * @return hasMany(ProductSubCategory::class)
     */
    public function subCategory()
    {
        return $this->hasMany(ProducSubCategory::class, 'categories_id', 'id');
    }

    /**
     *  category has many products relationship.
     *
     * @return hasMany(Product::class)
     */
    public function product()
    {
        return $this->hasMany(Product::class, 'categories_id', 'id');
    }
}
