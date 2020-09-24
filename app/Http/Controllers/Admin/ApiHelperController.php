<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\SubCategories;
use App\Models\LastCategories;
class ApiHelperController extends Controller
{
    public function categoriesIndex() {
        $categories = categories::get();

        return response()->json($categories);
    }

    public function subCategoryIndexWithCategoryId($id) {
        $sub_categories = SubCategories::where('categories_id',$id)->get();
        return response()->json($sub_categories);

    }

    public function lastCategoryIndexWithSubCategory($id) {
        $last_categories = LastCategories::where('sub_categories_id',$id)->get();
        return response()->json($last_categories);
    }
}
