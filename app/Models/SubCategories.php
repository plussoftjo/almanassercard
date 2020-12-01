<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class SubCategories extends Model
{
    use HasFactory;

    protected $fillable = ['title','SubTitle','amount','multi','categories_id','description'];
    public $with = ['LastCategories'];

    public function categories() {
        return $this->belongsTo('App\Models\categories');
    }

    public function Code() {
        return $this->belongsTo('App\Models\Code');
    }

    public function LastCategories() {
        return $this->hasMany('App\Models\LastCategories');
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Amman')
            ->toDateTimeString()
        ;
    }
}
