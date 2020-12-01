<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class wallet extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','amount'];

    public function User() {
        return $this->belongsTo('App\Models\User');
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Amman')
            ->toDateTimeString()
        ;
    }
}
