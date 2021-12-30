<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Render the Add User form.
     *
     * @return App\Models\Category
     */
    public function addProductForm()
    {
        return view('add_product', ['categories' => Category::all()]);
    }

    /**
     * Insert Data in users table
     *
     * @param Illuminate\Http\Request $request
     * 
     * @return session('status') = 'success' or 'failed'
     */
    public function addProduct(Request $request)
    {
        $validator = $request->validate([
            'pname' => 'required',
            'pbrand' => 'required',
            'pcategory' => 'required',
            'pquantity' => 'required|numeric',
            'pprice' => 'required|numeric',
            'psaleprice' => 'numeric',
            'pweight' => 'numeric',
            'pimages' => 'required',
            'pimages.*' => 'image|mimes:png,jpg'
        ], [
            'pname.required' => 'Product name is required',
            'pbrand.required' => 'Product brand is required',
            'pcategory.required' => 'Product category is required',
            'pquantity.required' => 'Product quanity is required',
            'pprice.required' => 'Product price is required',
            'pimgaes.required' => 'Product image is required',
            'pimages.mimes' => 'Only png and jpg files are allowed'
        ]);
        if ($validator) {
            $product = new Product();
            $product->name = $request->pname;
            $product->brand = $request->pbrand;
            $product->description = $request->pdescription;
            $product->quantity = $request->pquantity;
            $product->price = $request->pprice;
            $product->sale_price = $request->psaleprice;
            $product->weight = $request->pweight;
            if ($product->save()) {
                $product_id = $product->id;
                if ($request->hasfile('pimages')) {
                    foreach ($request->file('pimages') as $pimage) {
                        $image = 'product-' . time() . rand() . '.' . $pimage->extension();
                        $product_image = new ProductImage();
                        $product_image->product_id = $product_id;
                        $product_image->image = $image;
                        $product_image->save();
                        $pimage->move(public_path('products'), $image);
                    }
                    $product->categories()->attach(explode(', ', $request->pcategory));
                    return back()->with('status', 'success');
                } else {
                    return back()->with('status', 'failed');
                }
            } else {
                return back()->with('status', 'failed');
            }
        } else {
            return back()->with('status', 'failed');
        }
    }
}
