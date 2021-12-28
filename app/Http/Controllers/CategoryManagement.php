<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryManagement extends Controller
{
    /**
     * Render the All Users data.
     *
     * @return App\Models\Category 
     */
    public function getCategories() {
        return view('category_management', ['categories' => Category::all()]);
    }
}
