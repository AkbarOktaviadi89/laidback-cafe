<?php
// app/Http/Controllers/Cashier/PaymentController.php
namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function show($orderId)
    {
        $order = Order::with('items.product')
            ->where('status', 'pending')
            ->findOrFail($orderId);

        return view('cashier.payment', compact('order'));
    }

    public function process(Request $request, $orderId)
    {
        $request->validate([
            'payment_method' => 'required|in:cash,transfer',
            'amount_paid' => 'required|numeric|min:0',
        ]);

        $order = Order::findOrFail($orderId);

        if ($order->status !== 'pending') {
            return back()->with('error', 'Order already processed');
        }

        if ($request->amount_paid < $order->total) {
            return back()->with('error', 'Insufficient payment amount');
        }

        $changeAmount = $request->amount_paid - $order->total;

        DB::beginTransaction();
        try {
            $order->update([
                'status' => 'paid',
                'payment_method' => $request->payment_method,
                'amount_paid' => $request->amount_paid,
                'change_amount' => $changeAmount,
                'cashier_id' => auth()->id(),
                'paid_at' => now(),
            ]);

            // Update product stock
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    $product->decrement('stock', $item->quantity);
                }
            }

            DB::commit();

            return redirect()
                ->route('cashier.receipt', $order->id)
                ->with('success', 'Payment processed successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to process payment. Please try again.');
        }
    }

    public function receipt($orderId)
    {
        $order = Order::with(['items', 'cashier'])
            ->findOrFail($orderId);

        return view('cashier.receipt', compact('order'));
    }

    public function print($orderId)
    {
        $order = Order::with(['items', 'cashier'])
            ->findOrFail($orderId);

        return view('cashier.print-receipt', compact('order'));
    }
}