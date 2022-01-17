<?php

namespace App\Http\Controllers;

use App\Http\Resources\EcommerceResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class ProductController extends Controller
{
    /**
     * Render the All Product Details.
     *
     * @return App\Models\Product
     */
    public function getProducts()
    {
        return view('product_management', ['products' => Product::all()]);
    }

    /**
     * Render the Add Product form.
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
            'pimages' => 'required',
            'pthumbnail' => 'required|mimes:png,jpg',
            'pimages.*' => 'image|mimes:png,jpg'
        ], [
            'pname.required' => 'Product name is required',
            'pbrand.required' => 'Product brand is required',
            'pcategory.required' => 'Product category is required',
            'pquantity.required' => 'Product quanity is required',
            'pprice.required' => 'Product price is required',
            'pimgaes.required' => 'Product image is required',
            'pimages.mimes' => 'Only png and jpg files are allowed',
            'pthumbnail.required' => 'Product thumbnail is required',
            'pthumbnail.mimes' => 'Only png and jpg files are allowed',
        ]);
        if ($validator) {
            $product = new Product();
            $product->name = $request->pname;
            $product->brand = $request->pbrand;
            $product->description = $request->pdescription;
            $product->quantity = $request->pquantity;
            $product->price = $request->pprice;
            $thumbnail = 'products/product-' . time() . rand() . '.' . $request->pthumbnail->extension();
            $product->thumbnail = $thumbnail;
            $product->sold = 0;
            $request->pthumbnail->move(public_path('products'), $thumbnail);
            if ($request->pfeatured) {
                $product->featured = $request->pfeatured;
            }
            if ($product->save()) {
                $product_id = $product->id;
                if ($request->hasfile('pimages')) {
                    foreach ($request->file('pimages') as $pimage) {
                        $image = 'products/product-' . time() . rand() . '.' . $pimage->extension();
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

    /**
     * Delete User data.
     *
     * @param $id
     * @return void
     */
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        foreach ($product->images as $image) {
            unlink(public_path($image->image));
        }
        $product->delete();
    }

    /**
     * Render the Product Images.
     *
     * @param $id
     * 
     * @return App\Models\Product
     */
    public function getProductImages($id)
    {
        return view('product_images', ['product' => Product::find($id)]);
    }

    /**
     * Edit user details
     *
     * @param $id
     * 
     * @return App\Models\Product
     * @return App\Models\Category
     */
    public function editProduct($id)
    {
        return view('edit_product', ['categories' => Category::all(), 'product' => Product::find($id)]);
    }

    /**
     * Edit user details
     *
     * @param $id
     * 
     * @return Illuminate\Http\Response
     */
    public function editProductDetails(Request $request)
    {
        $validator = $request->validate([
            'pname' => 'required',
            'pbrand' => 'required',
            'pcategory' => 'required',
            'pquantity' => 'required|numeric',
            'pprice' => 'required|numeric',
            'pimages.*' => 'image|mimes:png,jpg'
        ], [
            'pname.required' => 'Product name is required',
            'pbrand.required' => 'Product brand is required',
            'pcategory.required' => 'Product category is required',
            'pquantity.required' => 'Product quanity is required',
            'pprice.required' => 'Product price is required',
            'pimages.mimes' => 'Only png and jpg files are allowed'
        ]);
        if ($validator) {
            $product = Product::find($request->id);
            $product->name = $request->pname;
            $product->brand = $request->pbrand;
            $product->description = $request->pdescription;
            $product->quantity = $request->pquantity;
            $product->price = $request->pprice;
            if ($request->pthumbnail) {
                $request->pthumbnail->move(public_path('products'), $product->thumbnail);
            }
            if ($request->pfeatured) {
                $product->featured = $request->pfeatured;
            }
            if ($product->save()) {
                $product_id = $product->id;
                if ($request->hasfile('pimages')) {
                    foreach ($request->file('pimages') as $pimage) {
                        $image = 'product-' . time() . rand() . '.' . $pimage->extension();
                        $product_image = new ProductImage();
                        $product_image->product_id = $product_id;
                        $product_image->image = 'products/' . $image;
                        $product_image->save();
                        $pimage->move(public_path('products'), $image);
                    }
                }
                $product->categories()->sync(explode(', ', $request->pcategory));
                return redirect('/product-management')->with('status', 'success');
            } else {
                return back()->with('status', 'failed');
            }
        } else {
            return back()->with('status', 'failed');
        }
    }

    /**
     * Delete Product Image.
     *
     * @param $id
     * 
     * @return void
     */
    public function deleteProductImage($id)
    {
        $product_image = ProductImage::find($id);
        unlink(public_path($product_image->image));
        $product_image->delete();
    }

    /**
     * get all Product details (Product API).
     * 
     * @return App\Http\Resources\EcommerceResource
     */
    public function getProductsApi()
    {
        $products = Product::all();
        return response(['products' => EcommerceResource::collection($products), 'message' => 'All products fetched'], 200);
    }

    /**
     * get all featured details (Featured Product API).
     * 
     * @return App\Http\Resources\EcommerceResource
     */
    public function getProductApi($id)
    {
        $product = Product::with(['images'])->find($id);
        return response()->json(['product' => $product, 'message' => 'Products details is fetched'], 200);
    }

}
