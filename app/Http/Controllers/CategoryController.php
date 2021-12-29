<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Render the All Users data.
     *
     * @return App\Models\Category
     */
    public function getCategories()
    {
        return view('category_management', ['categories' => Category::all()]);
    }

    
}
