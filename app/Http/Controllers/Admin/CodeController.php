<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Code;
use App\Models\User;
use App\Models\Order;
class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function show_code() {
        $codes = Code::where('active',0)->get();
        return view('Containers/Admin/Code',[
            'codes' => $codes
        ]);
    }

    public function show_add_code() {
        return view('Containers/Admin/AddCode');
    }

    public function show_edit_code($id) {
        $code = Code::where('id',$id)->first();
        return view('Containers/Admin/EditCode',[
            'code' => $code
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->code as $code) {
            $code = Code::create([
                'code' => $code,
                'serial' => $request->serial,
                'categories_id' => $request->category,
                'sub_categories_id' => $request->sub_category,
                'sub_sub_categories_id' => $request->last_category
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Code::where('id',$id)->update([
            'code' => $request->code,
            'categories_id' => $request->category,
            'serial' => $request->serial,
            'sub_categories_id' => $request->sub_category,
            'sub_sub_categories_id' => $request->last_category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Code::where('id',$id)->delete();
    }

    public function CodeTrash() {
        $codes = Code::where('active',1)->get();
        return view('Containers/Admin/CodeTrash',[
        'codes' => $codes
        ]);
    }

    public function updateActive($id) {
        $code = Code::where('id',$id)->update([
            'active' => 1
        ]);
    }

    public function CodeChecker() {
        return view('Containers/Admin/CodeChecker');
    }

    public function CheckCode(Request $request) {
        $code = Code::where('code',$request->code)->first();

        /**
         * Type = 0 // Code Not Exiets
         * Type = 1 // Code Exits But Not Have Order
         */
        if($code === null) {
            return response()->json(['type' => 0]);
        }else {
            
            // If Code Exeits
            $isOrdered = Order::where('code_id',$code->id)->first();
            if($isOrdered === null) {
                return response()->json([
                    'type' => 1,
                    'code' => $code
                ]);
            }else {
                $user = User::where('id',$isOrdered->user_id)->first();
                return response()->json([
                    'type' => 2,
                    'code' => $code,
                    'order' => $isOrdered,
                    'user' => $user
                ]);
            }

        }

    }
}
