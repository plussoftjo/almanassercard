<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class LastCategories extends Model
{
    use HasFactory;
    protected $fillable = ['sub_categories_id','title','SubTitle','amount','descriptions'];

    public function SubCategories() {
        return $this->belongsTo('App\Models\SubCategories');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Amman')
            ->toDateTimeString()
        ;
    }
}
