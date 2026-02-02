<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // List all orders
    public function index()
    {
        $orders = Order::with('user')->get();
        return response()->json($orders);
    }

    // Show a single order
    public function show($id)
    {
        $order = Order::with('user')->find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        return response()->json($order);
    }

    // Create a new order
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'status' => 'sometimes|string',
        ]);

        $order = Order::create($request->all());

        return response()->json($order, 201);
    }

    // Update an order
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $request->validate([
            'total_price' => 'sometimes|numeric',
            'status' => 'sometimes|string',
        ]);

        $order->update($request->all());

        return response()->json($order);
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Order deleted']);
    }
}
