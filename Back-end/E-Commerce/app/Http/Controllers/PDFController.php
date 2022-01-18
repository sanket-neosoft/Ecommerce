<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    /**
     * get all Coupons details 
     * 
     * @return view
     */
    public function getCoupons()
    {
        $coupons = Coupon::all();
        return view('pdf.coupons', ['coupons' => $coupons]);
    }

    /**
     * get all Users details 
     * 
     * @return view
     */
    public function getUsers()
    {
        $users = User::where('role_id', 5)->get();
        return view('pdf.users', ['users' => $users]);
    }

     /**
     * download all product details pd
     * 
     * @return view
     */
    public function downloadProducts() {
        $products = Product::all();
        $pdf = PDF::loadview('pdf.products', ['products'=> $products]);
        return $pdf->download('products.pdf');
    }

    /**
     * download all coupon details pd
     * 
     * @return view
     */
    public function downloadCoupons() {
        $coupons = Coupon::all();
        $pdf = PDF::loadview('pdf.coupons', ['coupons'=> $coupons]);
        return $pdf->download('coupons.pdf');
    }

    /**
     * download all customers details pd
     * 
     * @return view
     */
    public function downloadUsers() {
        $users = User::where('role_id', 5)->get();
        $pdf = PDF::loadview('pdf.users', ['users'=> $users]);
        return $pdf->download('users.pdf');
    }

}
