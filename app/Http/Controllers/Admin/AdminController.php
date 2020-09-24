<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\Code;
use App\Models\Order;
class AdminController extends Controller
{
    public function dashboard() {
        $categories_count = categories::count();
        $code_count = Code::count();
        $order_count = Order::count();
        return view('Containers.Admin.Dashboard',[
            'categories_count' => $categories_count,
            'code_count' => $code_count,
            'order_count' => $order_count
        ]);
    }
}
