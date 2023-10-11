<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $table = 'subscription_plans';

    protected $fillable = [
        'plan',
        'price',
        'currency',
        'offered_price',
        'active',
        'total_users',
        'start_date',
        'end_date',
        'duration',
        'description'
    ];

    protected $dates = ['start_date', 'end_date'];
}
