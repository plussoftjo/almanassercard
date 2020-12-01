<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Order extends Model
{
    use HasFactory;
    public $with = ['categories','Code','SubCategories','LastCategories'];

    protected $fillable = ['user_id','code_id','categories_id','sub_categories_id','amount','last_categories_id'];

    public function categories() {
        return $this->belongsTo('App\Models\categories');
    }

    public function Code() {
        return $this->belongsTo('App\Models\Code');
    }

    public function SubCategories() {
        return $this->belongsTo('App\Models\SubCategories');
    }

    public function LastCategories() {
        return $this->belongsTo('App\Models\LastCategories');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Amman')
            ->toDateTimeString()
        ;
    }

}
