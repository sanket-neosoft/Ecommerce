<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class CategoryManagement extends Controller
{
    /**
     * Render the All Users data.
     *
     * @return App\Models\ProductCategory 
     * @return App\Models\ProductSubCategory
     */
    public function getCategories() {
        return view('category_management', ['categories' => ProductCategory::all(), 'subcategories' => ProductSubCategory::all()]);
    }
}
