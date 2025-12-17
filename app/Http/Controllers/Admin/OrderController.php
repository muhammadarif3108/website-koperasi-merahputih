<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,diproses,selesai,dibatalkan',
        ]);

        // Jika status berubah menjadi selesai, kurangi stok produk
        if ($validated['status'] === 'selesai' && $order->status !== 'selesai') {
            $product = $order->product;
            $product->stock -= $order->quantity;
            $product->save();
        }

        $order->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Status pesanan berhasil diupdate!');
    }
}
