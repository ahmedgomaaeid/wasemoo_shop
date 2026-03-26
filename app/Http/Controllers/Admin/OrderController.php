<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('product')->where('type', '>', 0)->latest();

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        $orders = $query->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }
}
