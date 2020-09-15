<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
class MainController extends Controller
{
    public function index() {
       $categories = categories::where('type',0)->get();
       $other_categories = categories::where('type',1)->get();
       return response()->json(['categories' => $categories,'other_categories' => $other_categories]);
    }

    public function search(Request $request) {
        // 'title','LIKE','%'.$request->title.'%'

        $categories = categories::where('title','LIKE','%'.$request->title.'%')->get();

        return response()->json($categories);
    }
}
