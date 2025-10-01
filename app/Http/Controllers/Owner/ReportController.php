<?php
// app/Http/Controllers/Owner/ReportController.php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfMonth()->format('Y-m-d'));

        // Sales Summary
        $totalRevenue = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'paid')
            ->sum('total');

        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $totalCustomers = Order::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('customer_name')
            ->count('customer_name');

        // Daily Sales
        $dailySales = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'paid')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(total) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top Products
        $topProducts = OrderItem::whereBetween('created_at', [$startDate, $endDate])
            ->select('product_name')
            ->selectRaw('SUM(quantity) as total_quantity, SUM(subtotal) as total_revenue')
            ->groupBy('product_name')
            ->orderByDesc('total_revenue')
            ->limit(10)
            ->get();

        // Payment Methods
        $paymentMethods = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'paid')
            ->select('payment_method')
            ->selectRaw('COUNT(*) as count, SUM(total) as total')
            ->groupBy('payment_method')
            ->get();

        return view('owner.reports.index', compact(
            'startDate',
            'endDate',
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'dailySales',
            'topProducts',
            'paymentMethods'
        ));
    }

    public function daily(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));

        $orders = Order::whereDate('created_at', $date)
            ->with(['items', 'cashier'])
            ->get();

        $summary = [
            'total_revenue' => $orders->where('status', 'paid')->sum('total'),
            'total_orders' => $orders->count(),
            'pending_orders' => $orders->where('status', 'pending')->count(),
            'completed_orders' => $orders->where('status', 'paid')->count(),
        ];

        return view('owner.reports.daily', compact('date', 'orders', 'summary'));
    }

    public function monthly(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));

        $startDate = Carbon::parse($month)->startOfMonth();
        $endDate = Carbon::parse($month)->endOfMonth();

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'paid')
            ->get();

        $summary = [
            'total_revenue' => $orders->sum('total'),
            'total_orders' => $orders->count(),
            'avg_order_value' => $orders->avg('total'),
            'total_customers' => $orders->unique('customer_name')->count(),
        ];

        $dailyBreakdown = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'paid')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(total) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('owner.reports.monthly', compact('month', 'summary', 'dailyBreakdown'));
    }

    public function export(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', now()->endOfMonth()->format('Y-m-d'));

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->with(['items', 'cashier'])->get();

        $filename = "sales_report_{$startDate}_to_{$endDate}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'Order Number',
                'Date',
                'Customer Name',
                'Table',
                'Items',
                'Subtotal',
                'Tax',
                'Total',
                'Payment Method',
                'Status',
                'Cashier'
            ]);

            // Data
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_number,
                    $order->created_at->format('Y-m-d H:i'),
                    $order->customer_name,
                    $order->table_number ?? '-',
                    $order->items->count(),
                    number_format($order->subtotal, 0),
                    number_format($order->tax, 0),
                    number_format($order->total, 0),
                    ucfirst($order->payment_method),
                    ucfirst($order->status),
                    $order->cashier->name ?? '-'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}