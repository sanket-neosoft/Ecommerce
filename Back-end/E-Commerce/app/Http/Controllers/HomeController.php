<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_count = User::where('role_id', 5)->count();
        $products = Product::all();
        $product_sales = 0;
        foreach ($products as $product) {
            $product_sales += $product->sold;
        }

        $coupon_used = 0;
        $coupons = Coupon::all();
        foreach ($coupons as $coupon) {
            $coupon_used += $coupon->used;
        }

        return view('home', ['user_count' => $user_count, 'products_sales' => $product_sales, 'coupon_used' => $coupon_used, 'categories' => Category::all()]);
    }
}
