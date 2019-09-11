<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrdersController extends Controller
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

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(20);

        return view('admin/orders', [
            'page' => 'orders',
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        return view('admin/order', [
            'page' => 'order',
            'order' => $order,
            'choseOptions' => $order->choices
        ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back();
    }
}
