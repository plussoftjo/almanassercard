<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    public $with = ['categories','SubCategories'];

    protected $fillable = ['code','categories_id','sub_categories_id','sub_sub_categories_id','active'];


    public function categories() {
        return $this->belongsTo('App\Models\categories');
    }
    public function SubCategories() {
        return $this->belongsTo('App\Models\SubCategories');
    }
}
