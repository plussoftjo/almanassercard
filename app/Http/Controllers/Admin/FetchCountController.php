<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Code;
class FetchCountController extends Controller
{
    public function index() {
        return view('Containers.Admin.FetchCount');
    }

    public function fetch(Request $request) {
        $has_last_category = $request->has_last_category;

        if(!$has_last_category) {
            $codes = Code::where('categories_id',$request->categories_id)->where('sub_categories_id',$request->sub_categories_id)->get();
            return response()->json($codes);
        }else {
            $codes =
            Code::where('categories_id',$request->categories_id)->where('sub_categories_id',$request->sub_categories_id)->where('sub_sub_categories_id',$request->last_categories_id)->get();
            return response()->json($codes);
        }
    }
}
