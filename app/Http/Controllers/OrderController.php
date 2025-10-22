<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());
        return new OrderResource($order);
    }

    //public function show($id)
     public function show(Order $order)
    {
        //return new OrderResource(Order::findOrFail($id));
        return new OrderResource($order);
    }

   // public function update(Request $request, $id)
      public function update(Request $request, Order $order)
    {
       // $order = Order::findOrFail($id);
        $order->update($request->all());
        return new OrderResource($order);
    }

    //public function destroy($id)
     public function destroy(Order $order)
    {
        //$order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }
}

