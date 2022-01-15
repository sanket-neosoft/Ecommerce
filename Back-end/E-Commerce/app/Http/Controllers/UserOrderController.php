<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\UserOrder;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    /**
     * Render the All Order Details.
     *
     * @return App\Models\UserOrder
     */
    public function getOrders()
    {
        return view('order_management', ['orders' => OrderDetail::all()]);
        // return OrderDetail::all();
    }

    /**
     * Render the  Order Details.
     *
     * @return App\Models\UserOrder
     */
    public function getOrder($id)
    {
        return response()->json(['order' => OrderDetail::with(['user_order', 'product'])->find($id)]);
    }

    /**
     * Edit Order Details.
     *
     * @return App\Models\UserOrder
     */
    public function editOrder(Request $request, $id)
    {
        $order = OrderDetail::find($id);
        $order->status = $request->status;
        if ($order->save()) {
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
