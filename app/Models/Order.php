<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $with = ['categories','Code','SubCategories'];

    protected $fillable = ['user_id','code_id','categories_id','sub_categories_id','amount'];

    public function categories() {
        return $this->belongsTo('App\Models\categories');
    }

    public function Code() {
        return $this->belongsTo('App\Models\Code');
    }

    public function SubCategories() {
        return $this->belongsTo('App\Models\SubCategories');
    }

}
