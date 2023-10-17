<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanRequest extends Model
{
   protected $table = 'plan_requests';

    protected $fillable = [
        'company_id',
        'transaction_id',
        'subs_plan_id',
        'start_date',
        'end_date',
        'hold_date',
        'status',
        'is_offer_price',
    ];

    public function plan()
    {
        return $this->hasOne('App\Models\Plan', 'id', 'plan_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
