<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketplaceController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('member.marketplace.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('member.marketplace.show', compact('product'));
    }

    public function order(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);

        $total = $product->price * $validated['quantity'];

        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'total_price' => $total,
            'status' => 'pending'
        ]);

        return redirect()->route('member.orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat! Silakan upload bukti pembayaran.');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.orders.index', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('member.orders.show', compact('order'));
    }

    public function uploadPayment(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')->store('payments', 'public');

        $order->update([
            'bukti_pembayaran' => $path
        ]);

        return redirect()->route('member.orders.show', $order)
            ->with('success', 'Bukti pembayaran berhasil diupload!');
    }
}
