<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class WalletLogs extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','amount','old_amount'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('Asia/Amman')
            ->toDateTimeString()
        ;
    }
}
