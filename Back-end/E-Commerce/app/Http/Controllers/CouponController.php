<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Render the All Coupons Details.
     *
     * @return App\Models\Coupon
     */
    public function getCoupons()
    {
        return view('coupon_management', ['coupons' => Coupon::all()]);
    }

    /**
     * Render the All Coupons Details.
     *
     * @return App\Models\Coupon
     */
    public function addCouponForm()
    {
        return view('add_coupon');
    }

    /**
     * Add Coupon.
     *
     * @return flash Session
     */
    public function addCoupon(Request $request)
    {
        $validator = $request->validate([
            'ccode' => 'required|alpha_num|unique:coupons,code',
            'cmin' => 'required|numeric',
            'cpercent' => 'required|numeric',
            'climit' => 'required|numeric',
            'cquantity' => 'required|numeric',
        ], [
            'ccode.alpha_num' => 'Only alphabets and numbers are allowed',
            'ccode.unique' => 'Coupon code is already used',
            'ccode.required' => 'Coupon code is required',
            'cmin.numeric' => 'Only numbers are allowed',
            'cmin.required' => 'Minimum amount is required',
            'cpercent.numeric' => 'Only numbers are allowed',
            'cpercent.required' => 'Coupon percentage is required',
            'climit.numeric' => 'Only numbers are allowed',
            'climit.required' => 'Coupon Limitis required',
            'cquantity.numeric' => 'Only numbers are allowed',
            'cquantity.required' => 'Coupon quantity is required',
        ]);
        if ($validator) {
            $coupon = new Coupon();
            $coupon->code = strtoupper($request->ccode);
            $coupon->minvalue = $request->cmin;
            $coupon->percent  = $request->cpercent;
            $coupon->limit = $request->climit;
            $coupon->quantity = $request->cquantity;
            $coupon->used = 0;
            if ($coupon->save()) {
                return back()->with('status', 'success');
            } else {
                return back()->with('status', 'failed');
            }
        }
    }

    /**
     * Returns response
     *
     * @param $id
     * 
     * @return Illuminate\Http\Response
     */
    public function editCoupon(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'cmin' => 'required|numeric',
            'cpercent' => 'required|numeric',
            'climit' => 'required|numeric',
            'cquantity' => 'required|numeric',
        ], [
            'cmin.numeric' => 'Only numbers are allowed',
            'cmin.required' => 'Minimum amount is required',
            'cpercent.numeric' => 'Only numbers are allowed',
            'cpercent.required' => 'Coupon percentage is required',
            'climit.numeric' => 'Only numbers are allowed',
            'climit.required' => 'Coupon Limitis required',
            'cquantity.numeric' => 'Only numbers are allowed',
            'cquantity.required' => 'Coupon quantity is required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $coupon = Coupon::find($id);
            $coupon->minvalue = $request->cmin;
            $coupon->percent  = $request->cpercent;
            $coupon->limit = $request->climit;
            $coupon->quantity = $request->cquantity;
            if ($coupon->save()) {
                return response()->json('success');
            } else {
                return response()->json(['failed']);
            }
        }
    }
    /**
     * Delete Coupon data.
     *
     * @param $id
     * @return void
     */
    public function getCoupon($id)
    {
        return response()->json(Coupon::find($id));
    }

    /**
     * Delete Coupon data.
     *
     * @param $id
     * @return void
     */
    public function deleteCoupon($id)
    {
        Coupon::find($id)->delete();
    }
}
