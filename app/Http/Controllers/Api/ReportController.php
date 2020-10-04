<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
class ReportController extends Controller
{
    public function fetch(Request $request) {
        switch ($request->type) {
            case 'Today':
            $orders = Order::where('user_id',$request->user_id)->whereDate('created_at', Carbon::today())->get();
            return response()->json($orders);
            case 'Month':
            $orders = Order::where('user_id',$request->user_id)->whereMonth('created_at',Carbon::now()->month)->get();
            return response()->json($orders);
            case 'All':
            $orders = Order::where('user_id',$request->user_id)->get();
            return response()->json($orders);
            default:
            # code...
            return response()->json(['message' => 'Not Selected']);
        }
    }
}
