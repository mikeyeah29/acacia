<?php

namespace App\Http\Controllers\API;

use App\Order;
use App\OrderChoice;
use App\Option;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // validate order

        // create order
            // in create order on order model -> create order choices
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $totalPrice = 0;
        $choseOptions = [];

        // validate
        request()->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'phone' => 'nullable',
            'comments' => 'nullable',
            'country' => 'nullable',
            'chosen_options' => 'required:array'
        ]);

        $options = Option::findMany(json_decode($request->chosen_options));

        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->comments = $request->comments;
        $order->country = $request->country;

        foreach($options as $option) {
            $totalPrice = $totalPrice + $option->cost;
        }

        $order->cost = $totalPrice;
        $order->save();

        foreach($options as $option) {
            $choseOptions[] = array(
                'order_id' => $order->id,
                'attribute' => $option->attribute->name,
                'chosen_option' => $option->name,
                'name' => $option->name,
                'cost' => $option->cost
            );
        }

        OrderChoice::insert($choseOptions);

        return response()->json(['message' => 'order created'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Order deleted'], 200);
    }
}
