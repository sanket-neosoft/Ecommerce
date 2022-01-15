<?php

namespace App\Http\Controllers;

use App\Http\Resources\EcommerceResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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


    /**
     * Render the Add Category form.
     *
     * @return view
     */
    public function addCategoryForm()
    {
        return view('add_category');
    }

    /**
     * Add Category.
     *
     * @return flash Session
     */
    public function addCategory(Request $request)
    {
        $validator = $request->validate([
            'cname' => 'required|unique:categories,name',
        ], [
            'cname.required' => 'Category name is required',
            'cname.unique' => 'Category name is already taken',
        ]);
        if ($validator) {
            $category = new Category();
            $category->name = $request->cname;
            $category->description = $request->cdescription;
            if ($category->save()) {
                return back()->with('status', 'success');
            } else {
                return back()->with('status', 'failed');
            }
        }
    }

    /**
     * Returns the User data.
     *
     * @param $id
     * 
     * @return App\Models\Category 
     */
    public function getCategory($id)
    {
        return response()->json(Category::find($id));
    }

    /**
     * Returns response
     *
     * @param $id
     * 
     * @return Illuminate\Http\Response
     */
    public function editCategory(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->cname;
        $category->description = $request->cdescription;
        if ($category->save()) {
            return response()->json(['success']);
        }
    }

    /**
     * Delete User data.
     *
     * @param $id
     * @return void
     */
    public function deleteCategory($id)
    {
        Category::find($id)->delete();
    }

    /**
     * get all Categories details (Banner API).
     * 
     * @return App\Http\Resources\EcommerceResource
     */
    public function getCategoriesApi()
    {
        $category = Category::with(['products'])->get();
        return response(['categories' => EcommerceResource::collection($category), 'message' => 'All categories fetched'], 200);
    }

    /**
     * get particular Category Products details (Banner API).
     * 
     * @return App\Http\Resources\EcommerceResource
     */
    public function getCategoryProductsApi($id)
    {
        $category_products = Category::with(['products'])->find($id);
        return response()->json(['category' => $category_products, 'message' => 'Products of Category ' . $category_products->name . ' fetched'], 200);
    }
}
