<?php
// app/Http/Controllers/Customer/OrderController.php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        if (!session('customer_name')) {
            return redirect()->route('customer.name');
        }

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.menu')->with('error', 'Cart is empty');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;

        return view('customer.checkout', compact('cart', 'subtotal', 'tax', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,transfer',
            'notes' => 'nullable|string|max:500',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.menu')->with('error', 'Cart is empty');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;

        DB::beginTransaction();
        try {
            $order = Order::create([
                'customer_name' => session('customer_name'),
                'table_number' => session('table_number'),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            session()->forget(['cart', 'customer_name', 'table_number']);

            return redirect()->route('customer.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function success($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        return view('customer.success', compact('order'));
    }
}