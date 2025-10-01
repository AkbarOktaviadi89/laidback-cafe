<?php
// app/Http/Controllers/Cashier/TransactionController.php
namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $pendingOrders = Order::where('status', 'pending')
            ->with('items')
            ->latest()
            ->take(10)
            ->get();

        $todayOrders = Order::whereDate('created_at', today())
            ->count();

        $todayRevenue = Order::whereDate('created_at', today())
            ->where('status', 'paid')
            ->sum('total');

        $completedToday = Order::whereDate('created_at', today())
            ->where('status', 'paid')
            ->count();

        return view('cashier.dashboard', compact(
            'pendingOrders',
            'todayOrders',
            'todayRevenue',
            'completedToday'
        ));
    }

    public function list(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = $request->get('search');

        $transactions = Order::with(['items', 'cashier'])
            ->when($status !== 'all', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('order_number', 'like', "%{$search}%")
                      ->orWhere('customer_name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(20);

        return view('cashier.transactions', compact('transactions', 'status', 'search'));
    }

    public function show($orderId)
    {
        $order = Order::with(['items.product', 'cashier'])
            ->findOrFail($orderId);

        return view('cashier.transaction-detail', compact('order'));
    }
}