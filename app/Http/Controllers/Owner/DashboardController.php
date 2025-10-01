<?php

// app/Http/Controllers/Owner/DashboardController.php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'today');
        
        $dateRange = $this->getDateRange($period);

        // Total Revenue
        $totalRevenue = Order::whereBetween('created_at', $dateRange)
            ->where('status', 'paid')
            ->sum('total');

        // Total Orders
        $totalOrders = Order::whereBetween('created_at', $dateRange)
            ->count();

        // Total Customers
        $totalCustomers = Order::whereBetween('created_at', $dateRange)
            ->distinct('customer_name')
            ->count('customer_name');

        // Average Order Value
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // Top Products
        $topProducts = OrderItem::select('product_id', 'product_name', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(subtotal) as total_revenue'))
            ->whereHas('order', function ($query) use ($dateRange) {
                $query->whereBetween('created_at', $dateRange)
                      ->where('status', 'paid');
            })
            ->groupBy('product_id', 'product_name')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();

        // Revenue Trend (Last 7 days)
        $revenueTrend = Order::where('status', 'paid')
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as revenue'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Recent Transactions
        $recentTransactions = Order::with('cashier')
            ->latest()
            ->take(5)
            ->get();

        // Staff Performance
        $staffPerformance = User::where('role', 'cashier')
            ->withCount(['orders' => function ($query) use ($dateRange) {
                $query->whereBetween('created_at', $dateRange);
            }])
            ->get();

        // Low Stock Products
        $lowStockProducts = Product::where('stock', '<', 10)
            ->where('is_available', true)
            ->orderBy('stock')
            ->take(5)
            ->get();

        return view('owner.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'avgOrderValue',
            'topProducts',
            'revenueTrend',
            'recentTransactions',
            'staffPerformance',
            'lowStockProducts',
            'period'
        ));
    }

    private function getDateRange($period)
    {
        switch ($period) {
            case 'week':
                return [now()->startOfWeek(), now()->endOfWeek()];
            case 'month':
                return [now()->startOfMonth(), now()->endOfMonth()];
            case 'year':
                return [now()->startOfYear(), now()->endOfYear()];
            default: // today
                return [now()->startOfDay(), now()->endOfDay()];
        }
    }

    public function transactions(Request $request)
    {
        $transactions = Order::with(['items', 'cashier'])
            ->when($request->search, function ($query) use ($request) {
                $query->where('order_number', 'like', "%{$request->search}%")
                      ->orWhere('customer_name', 'like', "%{$request->search}%");
            })
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->date_from, function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->date_to);
            })
            ->latest()
            ->paginate(20);

        return view('owner.transactions', compact('transactions'));
    }

    public function showTransaction($orderId)
    {
        $order = Order::with(['items.product', 'cashier'])
            ->findOrFail($orderId);

        return view('owner.transaction-detail', compact('order'));
    }
}



