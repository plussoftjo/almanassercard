<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\Code;
use App\Models\Order;
use App\Models\User;
use App\Models\wallet;
use App\Models\WalletLogs;
use Illuminate\Support\Facades\DB;
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

    public function add_balance_view() {
        $users = User::get();
        return view('Containers.Admin.AddBalance',[
            'users' => $users
        ]);
    }

    public function add_balance(Request $request) {
        $wallet_count = wallet::where('user_id',$request->user_id)->count();
        if($wallet_count == 0){
            // Create new wallet 
            wallet::create([
                'user_id' => $request->user_id,
                'amount' => $request->wallet
            ]);

            WalletLogs::create([
                'user_id'=> $request->user_id,
                'amount' => $request->wallet,
                'old_amount' => "0"
            ]);
        }else {
            $wallet_value = wallet::where('user_id',$request->user_id)->value('amount');
            $newValue = $wallet_value + $request->wallet;

            wallet::where('user_id',$request->user_id)->update([
                'amount' => $newValue
            ]);

            WalletLogs::create([
                'user_id' => $request->user_id,
                'amount' => $request->wallet,
                'old_amount' => $wallet_value
            ]);
        }

        return response()->json(['message' => 'Success']);
    }

}
