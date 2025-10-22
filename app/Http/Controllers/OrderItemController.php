<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Http\Resources\OrderItemResource;

class OrderItemController extends Controller
{
    public function index()
    {
        return OrderItemResource::collection(OrderItem::all());
    }

    public function store(Request $request)
    {
        $orderItem = OrderItem::create($request->all());
        return new OrderItemResource($orderItem);
    }

    //public function show($id)
      public function show(OrderItem $orderItem)
    {
        //return new OrderItemResource(OrderItem::findOrFail($id));
          return new OrderItemResource($orderItem);
    }

    //public function update(Request $request, $id)
    public function update(Request $request, OrderItem $orderItem)
    {
       // $orderItem = OrderItem::findOrFail($id);
        $orderItem->update($request->all());
        return new OrderItemResource($orderItem);
    }

   // public function destroy($id)
     public function destroy(OrderItem $orderItem)
    {
        //$orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();
        return response()->json(null, 204);
    }
}
