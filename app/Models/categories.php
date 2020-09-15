<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;
    
    public $with = ['SubCategories'];
    protected $fillable = ['title','image','type'];

    public function SubCategories() {
        return $this->hasMany('App\Models\SubCategories');
    }

    public function Code() {
        return $this->hasMany('App\Models\Code');
    }
}
