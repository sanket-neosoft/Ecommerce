<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sample() {
        return view('mail.update_status', ['order_detail' => OrderDetail::with(['user_order', 'product'])->find(27)]);
        // return User::where('role_id', 1)->first()->config;
    }


}
