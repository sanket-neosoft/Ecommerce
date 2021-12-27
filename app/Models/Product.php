<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     *  Product belongs to category relationship.
     *
     * @return belongsTo(ProductCategory::class)
     */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'categories_id', 'id');
    }

    /**
     *  product belongs to subcategory relationship.
     *
     * @return belongsTo(ProductSubCategory::class)
     */
    public function subCategory()
    {
        return $this->belongsTo(ProducSubCategory::class, 'sub_categories_id', 'id');
    }
}
