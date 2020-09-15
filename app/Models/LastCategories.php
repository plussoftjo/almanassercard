<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastCategories extends Model
{
    use HasFactory;
    protected $fillable = ['sub_categories_id','title','SubTitle','amount','descriptions'];

    public function SubCategories() {
        return $this->belongsTo('App\Models\SubCategories');
    }
}
