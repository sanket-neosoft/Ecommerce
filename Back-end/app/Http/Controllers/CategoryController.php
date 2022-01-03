<?php

namespace App\Http\Controllers;

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
     * Render the All Users data.
     *
     * @return void
     */
    public function addCategoryForm()
    {
        return view('add_category');
    }

    /**
     * Add Category.
     *
     * @return void
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
}
