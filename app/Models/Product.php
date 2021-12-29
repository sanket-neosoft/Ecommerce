<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     *  Products belongs to many Categories relationship.
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsToMany
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    /**
     * Product has to Many Relationship
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    
}
