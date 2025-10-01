<?php
// app/Http/Controllers/Owner/ReportController.php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'daily');
        $dateFrom = $request->get('date_from', now()->startOfMonth());
        $dateTo = $request->get('date_to', now()->endOfMonth());

        $reportData = $this->generateReport($type, $dateFrom, $dateTo);

        return view('owner.reports.index', compact('reportData', 'type', 'dateFrom', 'dateTo'));
    }

    private function generateReport($type, $dateFrom, $dateTo)
    {
        $orders = Order::whereBetween('created_at', [$dateFrom, $dateTo])
            ->where('status', 'paid');

        return [
            'total_revenue' => $orders->sum('total'),
            'total_orders' => $orders->count(),
            'total_customers' => $orders->distinct('customer_name')->count('customer_name'),
            'avg_order_value' => $orders->avg('total'),
            'cash_payments' => $orders->where('payment_method', 'cash')->sum('total'),
            'transfer_payments' => $orders->where('payment_method', 'transfer')->sum('total'),
            'top_products' => $this->getTopProducts($dateFrom, $dateTo),
        ];
    }

    private function getTopProducts($dateFrom, $dateTo)
    {
        return OrderItem::select('product_name', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(subtotal) as total_revenue'))
            ->whereHas('order', function ($query) use ($dateFrom, $dateTo) {
                $query->whereBetween('created_at', [$dateFrom, $dateTo])
                      ->where('status', 'paid');
            })
            ->groupBy('product_name')
            ->orderByDesc('total_revenue')
            ->take(10)
            ->get();
    }

    public function export(Request $request)
    {
        // Implementation for exporting reports (CSV, PDF, etc.)
        // This is a placeholder - you can implement actual export functionality
        
        return back()->with('success', 'Report exported successfully');
    }
}