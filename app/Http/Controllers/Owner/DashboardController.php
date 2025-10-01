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
use Carbon\Carbon;

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

        // Previous Period Revenue for comparison
        $previousDateRange = $this->getPreviousDateRange($period);
        $previousRevenue = Order::whereBetween('created_at', $previousDateRange)
            ->where('status', 'paid')
            ->sum('total');
        
        $revenueGrowth = $previousRevenue > 0 
            ? (($totalRevenue - $previousRevenue) / $previousRevenue) * 100 
            : 0;

        // Total Orders
        $totalOrders = Order::whereBetween('created_at', $dateRange)->count();
        $previousOrders = Order::whereBetween('created_at', $previousDateRange)->count();
        $ordersGrowth = $previousOrders > 0 
            ? (($totalOrders - $previousOrders) / $previousOrders) * 100 
            : 0;

        // Total Customers (unique)
        $totalCustomers = Order::whereBetween('created_at', $dateRange)
            ->distinct('customer_name')
            ->count('customer_name');
        $previousCustomers = Order::whereBetween('created_at', $previousDateRange)
            ->distinct('customer_name')
            ->count('customer_name');
        $customersGrowth = $previousCustomers > 0 
            ? (($totalCustomers - $previousCustomers) / $previousCustomers) * 100 
            : 0;

        // Average Order Value
        $avgOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;
        $previousAvgOrderValue = $previousOrders > 0 ? $previousRevenue / $previousOrders : 0;
        $avgGrowth = $previousAvgOrderValue > 0 
            ? (($avgOrderValue - $previousAvgOrderValue) / $previousAvgOrderValue) * 100 
            : 0;

        // Revenue Trend Data (Last 7 days)
        $revenueTrend = Order::where('status', 'paid')
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->selectRaw('DATE(created_at) as date, SUM(total) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top Products
        $topProducts = OrderItem::select('product_name', 'product_id')
            ->selectRaw('SUM(quantity) as total_quantity')
            ->selectRaw('SUM(subtotal) as total_revenue')
            ->whereBetween('created_at', $dateRange)
            ->groupBy('product_name', 'product_id')
            ->orderByDesc('total_revenue')
            ->limit(5)
            ->with('product.category')
            ->get();

        // Recent Transactions
        $recentTransactions = Order::with(['items', 'cashier'])
            ->latest()
            ->limit(10)
            ->get();

        // Low Stock Products
        $lowStockProducts = Product::where('stock', '<=', 10)
            ->where('is_available', true)
            ->with('category')
            ->orderBy('stock')
            ->limit(5)
            ->get();

        // Cashier Performance
        $cashierPerformance = Order::where('status', 'paid')
            ->whereBetween('created_at', $dateRange)
            ->whereNotNull('cashier_id')
            ->select('cashier_id')
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw('SUM(total) as total_revenue')
            ->groupBy('cashier_id')
            ->with('cashier')
            ->orderByDesc('total_revenue')
            ->get();

        // Pending Orders Count
        $pendingOrders = Order::where('status', 'pending')->count();

        return view('owner.dashboard', compact(
            'totalRevenue',
            'revenueGrowth',
            'totalOrders',
            'ordersGrowth',
            'totalCustomers',
            'customersGrowth',
            'avgOrderValue',
            'avgGrowth',
            'revenueTrend',
            'topProducts',
            'recentTransactions',
            'lowStockProducts',
            'cashierPerformance',
            'pendingOrders',
            'period'
        ));
    }

    private function getDateRange($period)
    {
        return match($period) {
            'today' => [now()->startOfDay(), now()->endOfDay()],
            'week' => [now()->startOfWeek(), now()->endOfWeek()],
            'month' => [now()->startOfMonth(), now()->endOfMonth()],
            'year' => [now()->startOfYear(), now()->endOfYear()],
            default => [now()->startOfDay(), now()->endOfDay()],
        };
    }

    private function getPreviousDateRange($period)
    {
        return match($period) {
            'today' => [now()->subDay()->startOfDay(), now()->subDay()->endOfDay()],
            'week' => [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()],
            'month' => [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()],
            'year' => [now()->subYear()->startOfYear(), now()->subYear()->endOfYear()],
            default => [now()->subDay()->startOfDay(), now()->subDay()->endOfDay()],
        };
    }

    public function transactions(Request $request)
    {
        $status = $request->get('status', 'all');
        $search = $request->get('search');

        $transactions = Order::with(['items', 'cashier'])
            ->when($status !== 'all', fn($q) => $q->where('status', $status))
            ->when($search, function($q) use ($search) {
                $q->where(function($query) use ($search) {
                    $query->where('order_number', 'like', "%{$search}%")
                          ->orWhere('customer_name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(20);

        return view('owner.transactions', compact('transactions', 'status', 'search'));
    }

    public function showTransaction($orderId)
    {
        $order = Order::with(['items.product', 'cashier'])
            ->findOrFail($orderId);

        return view('owner.transaction-detail', compact('order'));
    }
}