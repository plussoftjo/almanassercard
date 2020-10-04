<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
class ReportController extends Controller
{
    public function index() {
        
        return view('Containers.Admin.Reports');
    }

    public function fetch($type) {
        switch ($type) {
            case 'today':
                $orders = Order::whereDate('created_at', Carbon::today())->get();
                return response()->json($orders);
            case 'month':
                $orders = Order::whereMonth('created_at',Carbon::now()->month)->get();
                return response()->json($orders);
            case 'all':
                $orders = Order::get();
                return response()->json($orders);
            default:
                # code...
                return response()->json(['message' => 'Not Selected']);
        }
    }
}
