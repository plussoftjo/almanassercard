<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\wallet;
use App\Models\Code;
use App\Models\SubCategories;
class OrderController extends Controller
{
    public function StoreOrder(Request $request) {
        // Check Wallet Amount 
        $wallet = Wallet::where('user_id',$request->user_id)->value('amount');
        // return response()->json($request->user_id);
        // Get Value of the SubCategories price 
        $CodePrice = SubCategories::where('id',$request->sub_categories_id)->value('amount');

        

        // Check if the wallet value has amount to get the code

        if($wallet >= $CodePrice) {
            // Check if Have Code 
            // Code Most have the same Categories the same SubCategories and active 
            $CodeCount = Code::
            where('categories_id',$request->categories_id)->
            where('sub_categories_id',$request->sub_categories_id)->
            where('active',0)->
            count();

            if($CodeCount == 0) {
                return response()->json([
                    'status' => 0, // No Code
                    'message' => 'There Are No Code'
                ]);
            }

            // Have Amount in the Wallet 
            $new_wallet_amount = $wallet - $CodePrice;
            $wallet = Wallet::where('user_id',$request->user_id)->update(['amount' => $new_wallet_amount]);

            // Get Code 
            $Code = Code::
            where('categories_id',$request->categories_id)->
            where('sub_categories_id',$request->sub_categories_id)->
            where('active',0)->
            first();

            // Register The Order

            $Order = Order::create([
                'user_id' => $request->user_id,
                'code_id' => $Code->id,
                'categories_id' => $request->categories_id,
                'sub_categories_id' => $request->sub_categories_id,
                'amount' => $CodePrice
            ]);

            // Code Change to the not active 
            Code::
            where('categories_id',$request->categories_id)->
            where('sub_categories_id',$request->sub_categories_id)->
            where('active',0)->
            update(['active' => 1]);

            // Return Response
            return response()->json([
                'status' => 1, // Success
                'message' => 'Success',
                'code' => $Code->code
            ]);

        }else {// Not have Amount from here 
            return response()->json([
                'status' => 2,
                'message' => 'There Are no amount in the wallet'
            ]);
        }

    }

    public function NewStoreOrder(Request $request) {
    // Check Wallet Amount
    $wallet = Wallet::where('user_id',$request->user_id)->value('amount');
    // return response()->json($request->user_id);
    // Get Value of the SubCategories price
    $CodePrice = $request->amount;



    // Check if the wallet value has amount to get the code

    if($wallet >= $CodePrice) {
    // Check if Have Code
    // Code Most have the same Categories the same SubCategories and active
    if($request->has_last) {
        $CodeCount = Code::
        where('categories_id',$request->categories_id)->
        where('sub_categories_id',$request->sub_categories_id)->
        where('sub_sub_categories_id',$request->last_categories_id)->
        where('active',0)->
        count();
    }else {
        $CodeCount = Code::
        where('categories_id',$request->categories_id)->
        where('sub_categories_id',$request->sub_categories_id)->
        where('active',0)->
        count();
    }
    

    if($CodeCount == 0) {
        return response()->json([
        'status' => 0, // No Code
        'message' => 'There Are No Code'
        ]);
    }

    // Have Amount in the Wallet
    $new_wallet_amount = $wallet - $CodePrice;
    $wallet = Wallet::where('user_id',$request->user_id)->update(['amount' => $new_wallet_amount]);

    // Get Code
    $Code = Code::
    where('categories_id',$request->categories_id)->
    where('sub_categories_id',$request->sub_categories_id)->
    where('active',0)->
    first();

    if($request->has_last) {
        $Code = Code::
        where('categories_id',$request->categories_id)->
        where('sub_categories_id',$request->sub_categories_id)->
        where('sub_sub_categories_id',$request->last_categories_id)->
        where('active',0)->
        first();
    }else {
        $Code = Code::
        where('categories_id',$request->categories_id)->
        where('sub_categories_id',$request->sub_categories_id)->
        where('active',0)->
        first();
    }

    if($request->has_last) {
        $last_categories_id = $request->last_categories_id;
    }else {
        $last_categories_id = 0;
    }

    // Register The Order

    $Order = Order::create([
    'user_id' => $request->user_id,
    'code_id' => $Code->id,
    'categories_id' => $request->categories_id,
    'sub_categories_id' => $request->sub_categories_id,
    'last_categories_id' => $last_categories_id,
    'amount' => $CodePrice
    ]);

    // Code Change to the not active
    Code::
    where('id',$Code->id)->
    update(['active' => 1]);

    // Return Response
    return response()->json([
    'status' => 1, // Success
    'message' => 'Success',
    'code' => $Code->code
    ]);

    }else {// Not have Amount from here
    return response()->json([
    'status' => 2,
    'message' => 'There Are no amount in the wallet'
    ]);
    }

    }

    public function index($user_id) {
        $order = Order::where('user_id',$user_id)->get();
        return response()->json($order);
    }
}
