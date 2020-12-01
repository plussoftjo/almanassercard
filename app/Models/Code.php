<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Code extends Model
{
    use HasFactory;

    public $with = ['categories','SubCategories','LastCategories'];

    protected $fillable = ['code','categories_id','sub_categories_id','sub_sub_categories_id','active','serial'];


    public function categories() {
        return $this->belongsTo('App\Models\categories');
    }
    public function SubCategories() {
        return $this->belongsTo('App\Models\SubCategories');
    }

    public function LastCategories() {
        return $this->belongsTo('App\Models\LastCategories','sub_sub_categories_id');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Amman')
            ->toDateTimeString()
        ;
    }
}
