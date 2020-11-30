<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\wallet;
use App\Models\Order;
class ClientController extends Controller
{
    public function index() {
        $users = User::get();

        return view('Containers/Admin/Clients',[
            'users' => $users
        ]);
    }

    public function show($id) {
        $user = User::where('id',$id)->first();
        $wallet = wallet::where('user_id',$id)->first();
        $order_count = Order::where('user_id',$id)->count();
        $spent = Order::where('user_id',$id)->sum('amount');


        return view('Containers/Admin/ShowClients',[
            'user' => $user,
            'wallet' => $wallet,
            'order_count' => $order_count,
            'spent' => $spent
        ]);
    }
}
