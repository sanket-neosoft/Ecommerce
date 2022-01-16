<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $order = OrderDetail::with(['user_order', 'product'])->find($id);
        $order->status = $request->status;
        if ($order->save()) {
            if ($request->status === 'Dispatched') {
                $product = Product::find($order->product_id);
                $product->quantity -= $request->quantity;
                $product->sold += $request->quantity;
                $product->save();
            }
            $user['to'] = $order->user_order->user_email;
            $user['subject'] = $request->status;
            $data = ['order_detail' => $order];
            Mail::send('mail.update_status', $data, function ($message) use ($user) {
                $message->to($user['to']);
                $message->subject('Your order ' . $user['subject']);
            });
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }
}
